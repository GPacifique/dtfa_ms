<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Group;
use App\Models\User;

class StudentsFromCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Expects a CSV file at `database/seeders/students_import.csv` with a header row.
     * The CSV should include a column with image path (e.g. `Profile Picture`)
     * and other columns like `First Name`, `Second Name`, `DOB`, `Email`, `Branch`, `Group`, etc.
     *
     * Photos referenced in the CSV should be present under the project `members_Images/` folder.
     */
    public function run()
    {
        $csvPath = database_path('seeders/students_import.csv');
        if (!file_exists($csvPath)) {
            $this->command->error("CSV not found: {$csvPath}. Create the file and re-run seeder.");
            return;
        }

        $handle = fopen($csvPath, 'r');
        if (!$handle) {
            $this->command->error('Unable to open CSV file.');
            return;
        }

        $header = fgetcsv($handle);
        if (!$header) {
            $this->command->error('CSV appears empty or malformed.');
            fclose($handle);
            return;
        }

        $header = array_map(fn($h) => trim((string)$h), $header);
        $rowCount = 0;
        $created = 0;

        while (($row = fgetcsv($handle)) !== false) {
            if (!is_array($row) || count($row) !== count($header)) {
                // try to pad shorter rows
                $row = array_pad($row, count($header), '');
            }
            $rowCount++;
            $data = array_combine($header, $row);
            if (!$data) continue;

            // Map common columns:
            $first = $data['First Name'] ?? $data['FirstName'] ?? $data['first_name'] ?? null;
            $second = $data['Second Name'] ?? $data['SecondName'] ?? $data['second_name'] ?? null;
            $email = $data['Email'] ?? null;
            $dobRaw = $data['DOB'] ?? null;
            $dob = $this->parseDate($dobRaw);
            $gender = $data['Gender'] ?? null;
            $father = $data["Father's Name"] ?? $data['Father'] ?? null;
            $mother = $data["Mother's Name"] ?? $data['Mother'] ?? null;
            $emergency = $data['Emergency Phone'] ?? $data['EmergencyPhone'] ?? $data['Emergency'] ?? null;
            $branchName = trim($data['Branch'] ?? $data['branch'] ?? '');
            $groupName = trim($data['Group'] ?? $data['group'] ?? '');
            $jerseyName = $data['Name on Jersey'] ?? $data['jersey_name'] ?? null;
            $jerseyNumber = $data['Jersey No'] ?? $data['Jersey No.'] ?? $data['jersey_number'] ?? null;
            $school = $data['Name of the School'] ?? $data['school_name'] ?? null;
            $position = $data['Position'] ?? null;
            $coach = $data['Coach'] ?? null;
            $combination = $data['COMBINATION'] ?? null;
            $membership = $data['Membership type'] ?? $data['membership_type'] ?? null;
            $joinedAt = $this->parseDate($data['Joined At'] ?? $data['JoinedAt'] ?? null);
            $program = $data['Program'] ?? null;
            $sport = $data['Sport Discipline'] ?? $data['sport_discipline'] ?? null;
            $status = $data['Status'] ?? ($data['status'] ?? 'active');
            $registeredByEmail = $data['Registeredby'] ?? $data['Registered By'] ?? null;

            // Photo handling: column may be named 'Profile Picture' or be the first column
            $photoCol = $data['Profile Picture'] ?? $data['members_Images'] ?? null;
            if (!$photoCol) {
                // try first CSV column
                $firstKey = $header[0] ?? null;
                $photoCol = $data[$firstKey] ?? null;
            }

            DB::beginTransaction();
            try {
                $student = new Student();
                $student->first_name = $first;
                $student->second_name = $second;
                if ($dob) $student->dob = $dob;
                if ($gender) $student->gender = strtolower($gender);
                $student->father_name = $father;
                $student->mother_name = $mother;
                $student->email = $email ?: null;
                $student->emergency_phone = $emergency;
                $student->jersey_name = $jerseyName;
                $student->jersey_number = $jerseyNumber;
                $student->school_name = $school;
                $student->position = $position;
                $student->coach = $coach;
                $student->combination = $combination;
                $student->membership_type = $membership;
                if ($joinedAt) $student->joined_at = $joinedAt;
                $student->program = $program;
                $student->sport_discipline = $sport;
                $student->status = $status ?: 'active';

                // Attach Branch if possible
                if ($branchName !== '') {
                    $branch = Branch::firstOrCreate(['name' => $branchName], ['name' => $branchName]);
                    $student->branch_id = $branch->id;
                }

                // Attach Group if possible
                if ($groupName !== '') {
                    $group = Group::firstOrCreate(['name' => $groupName], ['name' => $groupName]);
                    $student->group_id = $group->id;
                }

                // Registered by lookup
                if ($registeredByEmail) {
                    $regUser = User::where('email', trim($registeredByEmail))->first();
                    if ($regUser) $student->registered_by = $regUser->id;
                }

                $student->save();

                // Handle photo copy from members_Images
                if ($photoCol && trim($photoCol) !== '') {
                    $src = base_path(trim($photoCol));
                    // if path doesn't include base, try members_Images/
                    if (!file_exists($src)) {
                        $src = base_path(trim('members_Images/'.ltrim($photoCol, '/')));
                    }

                    if (file_exists($src)) {
                        $ext = pathinfo($src, PATHINFO_EXTENSION) ?: 'jpg';
                        $destFile = 'photos/students/'.$student->id.'_'.time().'.'.$ext;
                        $stream = fopen($src, 'r');
                        Storage::disk('public')->put($destFile, $stream);
                        if (is_resource($stream)) fclose($stream);
                        $student->photo_path = $destFile;
                        $student->save();
                    } else {
                        $this->command->warn("Photo not found for row {$rowCount}: {$photoCol}");
                    }
                }

                DB::commit();
                $created++;
            } catch (\Exception $e) {
                DB::rollBack();
                $this->command->error("Failed to import row {$rowCount}: {$e->getMessage()}");
            }
        }

        fclose($handle);
        $this->command->info("Import complete. Processed {$rowCount} rows. Created {$created} students.");
    }

    protected function parseDate($value)
    {
        $value = trim((string)$value);
        if ($value === '' || in_array(strtolower($value), ['125','0','n/a','na'], true)) return null;
        // Try common formats
        $formats = [
            'd/m/Y', 'd-m-Y', 'Y-m-d', 'Y/m/d', 'm/d/Y', 'd.m.Y'
        ];
        foreach ($formats as $f) {
            $dt = \DateTime::createFromFormat($f, $value);
            if ($dt && $dt->format($f) === $value) return $dt->format('Y-m-d');
        }
        // Try strtotime fallback
        $ts = strtotime($value);
        if ($ts !== false) return date('Y-m-d', $ts);
        return null;
    }
}
