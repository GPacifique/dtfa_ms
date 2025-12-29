<?php
namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class StudentAttendanceController extends Controller
{
    	/**
	 * Show the form for creating a new attendance record.
	 */
	public function create()
	{
		// You can customize this view as needed
		$students = Student::where('status', 'active')->get();
		$date = now()->toDateString();
		return view('attendance.create', compact('students', 'date'));
	}
public function index(Request $request)
{
	$date = $request->get('date', now()->toDateString());
	$showAll = $request->get('show_all', false);

	if ($showAll) {
		// Show all active students (for recording new attendance)
		$students = Student::where('status', 'active')
			->with(['attendance' => function ($q) use ($date) {
				$q->where('attendance_date', $date);
			}, 'group'])
			->orderBy('first_name')
			->get();
	} else {
		// Show only students with attendance records for this date
		$students = Student::whereHas('attendance', function ($q) use ($date) {
				$q->where('attendance_date', $date);
			})
			->with(['attendance' => function ($q) use ($date) {
				$q->where('attendance_date', $date);
			}, 'group'])
			->orderBy('first_name')
			->get();
	}

	return view('attendance.index', compact('students', 'date', 'showAll'));
}


	public function store(Request $request)
	{
		foreach ($request->attendance as $studentId => $status) {
			// Only save if student exists
			if (\App\Models\Student::where('id', $studentId)->exists()) {
				StudentAttendance::updateOrCreate(
					[
						'student_id' => $studentId,
						'attendance_date' => $request->date
					],
					[
						'status' => $status,
						'recorded_by' => Auth::check() ? Auth::id() : null,
						'remarks' => 'Bulk recorded'
					]
				);
			}
		}
		return back()->with('success', 'Attendance saved successfully');
	}

	/**
	 * Quick record attendance via AJAX for single student
	 */
	public function quickRecord(Request $request)
	{
		try {
			$validated = $request->validate([
				'student_id' => 'required|integer|exists:students,id',
				'attendance_date' => 'required|date',
				'status' => 'required|in:present,absent,late,excused'
			]);

			// Double-check student exists
			$student = Student::find($validated['student_id']);
			if (!$student) {
				return response()->json([
					'success' => false,
					'message' => 'Student not found'
				], 404);
			}

			$attendance = StudentAttendance::updateOrCreate(
				[
					'student_id' => $validated['student_id'],
					'attendance_date' => $validated['attendance_date']
				],
				[
					'status' => $validated['status'],
					'recorded_by' => Auth::check() ? Auth::id() : null,
					'remarks' => 'Quick recorded via AJAX'
				]
			);

			Log::info('Attendance recorded', [
				'student_id' => $validated['student_id'],
				'date' => $validated['attendance_date'],
				'status' => $validated['status'],
				'id' => $attendance->id
			]);

			return response()->json([
				'success' => true,
				'message' => 'Attendance recorded successfully',
				'data' => $attendance
			]);
		} catch (\Illuminate\Validation\ValidationException $e) {
			Log::warning('Validation error in quickRecord', $e->errors());
			return response()->json([
				'success' => false,
				'message' => 'Validation failed',
				'errors' => $e->errors()
			], 422);
		} catch (\Exception $e) {
			Log::error('Quick record failed: ' . $e->getMessage(), [
				'exception' => get_class($e),
				'trace' => $e->getTraceAsString()
			]);
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			], 400);
		}
	}

	/**
	 * Auto-record attendance for all active students for a specific date
	 */
	public function autoRecordAll(Request $request)
	{
		$date = $request->get('date', now()->toDateString());
		$status = $request->get('status', 'present');

		try {
			DB::beginTransaction();

			$students = Student::where('status', 'active')->get();
			$recorded = 0;
			$skipped = 0;

			foreach ($students as $student) {
				try {
					StudentAttendance::updateOrCreate(
						[
							'student_id' => $student->id,
							'attendance_date' => $date
						],
						[
							'status' => $status,
							'recorded_by' => Auth::check() ? Auth::id() : null,
							'remarks' => 'Auto-recorded'
						]
					);
					$recorded++;
				} catch (\Exception $e) {
					Log::error('Failed to record attendance for student ' . $student->id . ': ' . $e->getMessage());
					$skipped++;
				}
			}

			DB::commit();

			return back()->with('success', "Auto-recorded attendance for {$recorded} students (skipped: {$skipped}) on {$date}");

		} catch (\Exception $e) {
			DB::rollBack();
			Log::error('Auto-record attendance failed: ' . $e->getMessage());
			return back()->with('error', 'Failed to auto-record attendance: ' . $e->getMessage());
		}
	}

	/**
	 * Auto-record attendance for today (used by scheduled command)
	 */
	public function autoRecordToday()
	{
		$date = now()->toDateString();

		try {
			$students = Student::where('status', 'active')->get();
			$recorded = 0;

			foreach ($students as $student) {
				try {
					// Only create if not already exists for today
					$exists = StudentAttendance::where('student_id', $student->id)
						->where('attendance_date', $date)
						->exists();

					if (!$exists) {
						StudentAttendance::create([
							'student_id' => $student->id,
							'attendance_date' => $date,
							'status' => 'present',
							'recorded_by' => null,
							'remarks' => 'Auto-recorded by system'
						]);
						$recorded++;
					}
				} catch (\Exception $e) {
					Log::error('Failed to auto-record for student ' . $student->id . ': ' . $e->getMessage());
				}
			}

			Log::info("Auto-recorded attendance for {$recorded} students on {$date}");
			return $recorded;

		} catch (\Exception $e) {
			Log::error('Auto-record today failed: ' . $e->getMessage());
			return 0;
		}
	}

	/**
	 * Show attendance calendar view
	 */
	public function calendar(Request $request)
	{
		$month = $request->get('month', now()->format('Y-m'));
		$currentMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
		$startOfMonth = $currentMonth->copy()->startOfMonth();
		$endOfMonth = $currentMonth->copy()->endOfMonth();

		$prevMonth = $currentMonth->copy()->subMonth();
		$nextMonth = $currentMonth->copy()->addMonth();

		// Get attendance counts for each day of the month
		$attendanceCounts = StudentAttendance::whereBetween('attendance_date', [$startOfMonth, $endOfMonth])
			->selectRaw('attendance_date, status, COUNT(*) as count')
			->groupBy('attendance_date', 'status')
			->get()
			->groupBy('attendance_date');

		// Build calendar days array
		$calendarDays = [];
		$day = $startOfMonth->copy();

		while ($day <= $endOfMonth) {
			$dateStr = $day->format('Y-m-d');
			$dayCounts = $attendanceCounts->get($dateStr, collect());

			$calendarDays[] = [
				'date' => $day->copy(),
				'present_count' => $dayCounts->where('status', 'present')->sum('count'),
				'absent_count' => $dayCounts->where('status', 'absent')->sum('count'),
				'late_count' => $dayCounts->where('status', 'late')->sum('count'),
				'excused_count' => $dayCounts->where('status', 'excused')->sum('count'),
			];

			$day->addDay();
		}

		return view('attendance.calendar', compact(
			'currentMonth',
			'startOfMonth',
			'endOfMonth',
			'prevMonth',
			'nextMonth',
			'calendarDays'
		));
	}

	/**
	 * Get attendance data for a specific day (AJAX)
	 */
	public function getDayAttendance(Request $request)
	{
		$date = $request->get('date', now()->toDateString());

		$attendances = StudentAttendance::with(['student', 'student.branch', 'student.group'])
			->where('attendance_date', $date)
			->get();

		$students = $attendances->map(function ($attendance) {
			$student = $attendance->student;
			// Access the photo_url accessor explicitly
			$photoUrl = $student->photo_url;
			return [
				'id' => $student->id,
				'name' => $student->first_name . ' ' . ($student->second_name ?? ''),
				'photo_url' => $photoUrl,
				'jersey_name' => $student->jersey_name ?? null,
				'jersey_number' => $student->jersey_number ?? null,
				'coach' => $student->coach ?? null,
				'status' => $attendance->status,
				'branch' => $student->branch->name ?? null,
				'group' => $student->group->name ?? null,
				'remarks' => $attendance->remarks,
			];
		});

		$summary = [
			'present' => $attendances->where('status', 'present')->count(),
			'absent' => $attendances->where('status', 'absent')->count(),
			'late' => $attendances->where('status', 'late')->count(),
			'excused' => $attendances->where('status', 'excused')->count(),
		];

		return response()->json([
			'success' => true,
			'date' => $date,
			'students' => $students,
			'summary' => $summary,
		]);
	}
}
