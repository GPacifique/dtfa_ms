
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Student\CheckinController;
use App\Http\Controllers\Admin\CapacityBuildingController;
use App\Http\Controllers\Admin\InhouseTrainingController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\MatchController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\TrainingSessionController;


Route::middleware(['auth'])->group(function () {
    // Student Attendance (admin)
    Route::resource('admin/student-attendance', App\Http\Controllers\Admin\StudentAttendanceController::class)->names('admin.student-attendance');
    Route::get('/admin/student-attendance/bulk-create', [App\Http\Controllers\Admin\StudentAttendanceController::class, 'bulkCreate'])->name('admin.student-attendance.bulk-create');
    Route::post('/admin/student-attendance/bulk', [App\Http\Controllers\Admin\StudentAttendanceController::class, 'bulkStore'])->name('admin.student-attendance.bulk.store');
    Route::get('/admin/student-attendance/report', [App\Http\Controllers\Admin\StudentAttendanceController::class, 'report'])->name('admin.student-attendance.report');
    Route::get('/admin/student-attendance/report/export', [App\Http\Controllers\Admin\StudentAttendanceController::class, 'reportExportPdf'])->name('admin.student-attendance.report.export');
    // Auto-record attendance for a student (from students-modern)
    Route::post('/students-modern/{student}/attendance', [CheckinController::class, 'store'])->name('students-modern.attendance');
    // Session attendance
    Route::post('/admin/sessions/{session}/record-all-attendance', [\App\Http\Controllers\Admin\SessionsController::class, 'recordAllAttendance'])->name('admin.sessions.recordAllAttendance');
    Route::get('/admin/sessions/{session}/attendance', [\App\Http\Controllers\Admin\SessionsController::class, 'attendance'])->name('admin.sessions.attendance');
    Route::post('/admin/sessions/{session}/attendance', [\App\Http\Controllers\Admin\SessionsController::class, 'storeAttendance'])->name('admin.sessions.attendance.store');
    Route::get('/admin/sessions/{session}/attendance/export', [\App\Http\Controllers\Admin\SessionsController::class, 'exportAttendanceCsv'])->name('admin.sessions.attendance.export');
});



// Coach check-in route for students (fixes missing route error)

Route::middleware(['auth'])->group(function () {
    Route::get('/coach/checkin/{student}', [CheckinController::class, 'index'])->name('coach.checkin.index');
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::resource('users', App\Http\Controllers\Admin\UsersController::class);

    Route::post('users/{id}/restore', [App\Http\Controllers\Admin\UsersController::class, 'restore'])
        ->name('users.restore');

    Route::delete('users/{id}/force-delete', [App\Http\Controllers\Admin\UsersController::class, 'forceDelete'])
        ->name('users.forceDelete');   // ← THIS fixes the error
});
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('inhousetrainings', App\Http\Controllers\Admin\InhouseTrainingController::class);
    });

Route::middleware(['auth', 'role:admin|super-admin|coach|accountant'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('tasks', App\Http\Controllers\Admin\TaskController::class);
    });
    Route::middleware(['auth', 'role:admin|super-admin|coach|accountant'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('teams', App\Http\Controllers\Admin\TeamController::class);
    });
    Route::middleware(['auth', 'role:admin|super-admin|coach|accountant'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('groups', App\Http\Controllers\Admin\GroupsController::class);
    });
      Route::middleware(['auth', 'role:admin|super-admin|coach|accountant'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('sports-equipment', App\Http\Controllers\Admin\SportsEquipmentController::class);
    });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('games', GameController::class);
});

//public routes

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('capacity_buildings', \App\Http\Controllers\Admin\CapacityBuildingController::class);
});



// For all users
Route::resource('trainings', App\Http\Controllers\admin\TrainingSessionRecordController::class);
// Note: groups and teams resources are defined above with admin prefix

// Reports CRUD routes
Route::resource('reports', ReportController::class);
Route::get('reports-export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
Route::get('reports-export/pdf/me', [ReportController::class, 'exportPdfForMe'])->middleware('auth')->name('reports.export.pdf.me');

// Student self check-in (parents can check in their children)
Route::middleware(['auth'])->group(function () {
    Route::get('student/checkin', [CheckinController::class, 'index'])->name('student.checkin.index');
    Route::post('student/checkin', [CheckinController::class, 'store'])->name('student.checkin.store');
});

// Student profile routes (update own profile and photo)
Route::middleware(['auth'])->group(function () {
    Route::get('student/{student}/profile', [\App\Http\Controllers\Student\ProfileController::class, 'show'])->name('student.profile.show');
    Route::put('student/{student}/profile', [\App\Http\Controllers\Student\ProfileController::class, 'update'])->name('student.profile.update');
    Route::delete('student/{student}/profile/photo', [\App\Http\Controllers\Student\ProfileController::class, 'deletePhoto'])->name('student.profile.deletePhoto');
});

// Kit Manager Dashboard (accessible to kit-manager role)
Route::middleware(['auth', 'role:kit-manager|admin|super-admin'])->group(function () {
    Route::get('kit-manager/dashboard', [\App\Http\Controllers\KitManagerController::class, 'dashboard'])->name('kit-manager.dashboard');
});

// User dashboard route for all authenticated users
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'index'])->name('user.dashboard');

    // User profile routes (update own profile and picture)
    Route::get('{user}/profile', [\App\Http\Controllers\UserProfileController::class, 'show'])->name('user.profile.show');
    Route::put('{user}/profile', [\App\Http\Controllers\UserProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('{user}/profile/picture', [\App\Http\Controllers\UserProfileController::class, 'deletePicture'])->name('user.profile.deletePicture');
});

Route::get('/', function () {
    return view('welcome');
});

// Photo serving routes
Route::get('/photos/students/{student}', [\App\Http\Controllers\PhotoController::class, 'showStudent'])
    ->name('photos.student');
Route::get('/photos/staff/{staff}', [\App\Http\Controllers\PhotoController::class, 'showStaff'])
    ->name('photos.staff');
Route::get('/photos/users/{user}', [\App\Http\Controllers\PhotoController::class, 'showUser'])
    ->name('photos.user');

// Public guest dashboard
Route::get('/guest', [GuestController::class, 'index'])->name('guest.dashboard');

Route::get('/dashboard', function () {
    $user = Auth::user();

    // Safety: auth middleware should ensure $user is present
    if (!$user) {
        return redirect()->route('login');
    }

    // Resolve user roles without relying on IDE-unknown trait methods
    $roles = DB::table('model_has_roles')


        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    ->where('model_has_roles.model_id', $user->id)
        ->where('model_has_roles.model_type', get_class($user))
        ->pluck('roles.name')
        ->all();

    // Super Admin has highest priority - redirect to admin dashboard
    if (in_array('super-admin', $roles, true)) {
        return redirect()->route('admin.dashboard');
    }

    if (in_array('CEO', $roles, true)) {
        return redirect()->route('ceo.dashboard');
    }

    if (in_array('admin', $roles, true)) {
        return redirect()->route('admin.dashboard');
    }

    if (in_array('coach', $roles, true)) {
        return redirect()->route('coach.dashboard');
    }

    if (in_array('accountant', $roles, true)) {
        return redirect()->route('accountant.dashboard');
    }

    if (in_array('parent', $roles, true)) {
        return redirect()->route('parent.dashboard');
    }

    // Default for regular users
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Example protected route - requires auth and admin role
Route::get('/admin-only', function () {
    return 'Hello admin — you have access.';
})->middleware(['auth', 'role:admin']);

// Legacy admin student public endpoints removed in favor of modern CRUD

// Admin and User dashboards
Route::middleware(['auth', 'role:admin|super-admin|accountant'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // Note: User CRUD routes are defined at the top of this file using Route::resource('users', ...)
    // Only custom user routes that aren't part of RESTful resource are defined here:
    Route::put('/users/{user}/full', [\App\Http\Controllers\Admin\UsersController::class, 'updateFull'])->name('admin.users.updateFull');
    Route::post('/users/{user}/send-reset', [\App\Http\Controllers\Admin\UsersController::class, 'sendReset'])->name('admin.users.sendReset');

    // Session management
    Route::get('/sessions', [\App\Http\Controllers\Admin\SessionsController::class, 'index'])->name('admin.sessions.index');
    Route::get('/sessions/create', [\App\Http\Controllers\Admin\SessionsController::class, 'create'])->name('admin.sessions.create');
    Route::post('/sessions', [\App\Http\Controllers\Admin\SessionsController::class, 'store'])->name('admin.sessions.store');
    Route::get('/sessions/{session}/edit', [\App\Http\Controllers\Admin\SessionsController::class, 'edit'])->name('admin.sessions.edit');
    Route::put('/sessions/{session}', [\App\Http\Controllers\Admin\SessionsController::class, 'update'])->name('admin.sessions.update');
    Route::delete('/sessions/{session}', [\App\Http\Controllers\Admin\SessionsController::class, 'destroy'])->name('admin.sessions.destroy');
    Route::post('/sessions/{session}/record-all-attendance', [\App\Http\Controllers\Admin\SessionsController::class, 'recordAllAttendance'])->name('admin.sessions.recordAllAttendance');
    // Admin: per-session attendance management (view & save individual statuses)
    Route::get('/sessions/{session}/attendance', [\App\Http\Controllers\Admin\SessionsController::class, 'attendance'])->name('admin.sessions.attendance');
    Route::post('/sessions/{session}/attendance', [\App\Http\Controllers\Admin\SessionsController::class, 'storeAttendance'])->name('admin.sessions.attendance.store');
    // Export attendance CSV for a session
    Route::get('/sessions/{session}/attendance/export', [\App\Http\Controllers\Admin\SessionsController::class, 'exportAttendanceCsv'])->name('admin.sessions.attendance.export');
    // Income management
    Route::resource('incomes', \App\Http\Controllers\Admin\IncomeController::class, ['as' => 'admin']);

    // Teams / Players / Games (matches)
    // Note: teams resource is defined at the top with admin prefix
    Route::resource('players', \App\Http\Controllers\Admin\PlayerController::class, ['as' => 'admin']);

    // Game Prepare and Report Views (must be before resource routes)
    Route::get('games/{game}/prepare', [App\Http\Controllers\Admin\GameController::class, 'prepare'])->name('admin.games.prepare');
    Route::get('games/{game}/report', [App\Http\Controllers\Admin\GameController::class, 'report'])->name('admin.games.report');

    // Game Status Transitions
    Route::post('games/{game}/start', [App\Http\Controllers\Admin\GameController::class, 'startMatch'])->name('admin.games.start');
    Route::post('games/{game}/complete', [App\Http\Controllers\Admin\GameController::class, 'completeMatch'])->name('admin.games.complete');

    Route::resource('games', \App\Http\Controllers\Admin\GameController::class, ['as' => 'admin'])->names('games');

    // Minutes (Meeting Minutes)
    Route::resource('minutes', \App\Http\Controllers\Admin\MinuteController::class, ['as' => 'admin'])->names('minutes');

    // Minutes Status Transitions
    Route::post('minutes/{minute}/mark-completed', [App\Http\Controllers\Admin\MinuteController::class, 'markCompleted'])->name('admin.minutes.markCompleted');
    Route::post('minutes/{minute}/mark-cancelled', [App\Http\Controllers\Admin\MinuteController::class, 'markCancelled'])->name('admin.minutes.markCancelled');
    Route::post('minutes/{minute}/reschedule', [App\Http\Controllers\Admin\MinuteController::class, 'reschedule'])->name('admin.minutes.reschedule');

    // Student Attendance Management
    Route::resource('student-attendance', \App\Http\Controllers\Admin\StudentAttendanceController::class, ['as' => 'admin'])->names('student-attendance');
    Route::get('student-attendance-bulk/create', [\App\Http\Controllers\Admin\StudentAttendanceController::class, 'bulkCreate'])->name('admin.student-attendance.bulk.create');
    Route::post('student-attendance-bulk', [\App\Http\Controllers\Admin\StudentAttendanceController::class, 'bulkStore'])->name('admin.student-attendance.bulk.store');
    Route::get('student-attendance-report', [\App\Http\Controllers\Admin\StudentAttendanceController::class, 'report'])->name('admin.student-attendance.report');
    Route::get('student-attendance-report/export', [\App\Http\Controllers\Admin\StudentAttendanceController::class, 'reportExportPdf'])->name('admin.student-attendance.report.export');

    // Upcoming Events
    Route::resource('upcoming-events', \App\Http\Controllers\Admin\UpcomingEventController::class, ['as' => 'admin'])->names('upcoming-events');

    // Upcoming Events Status Transitions
    Route::post('upcoming-events/{upcomingEvent}/mark-ongoing', [App\Http\Controllers\Admin\UpcomingEventController::class, 'markOngoing'])->name('admin.upcoming-events.markOngoing');
    Route::post('upcoming-events/{upcomingEvent}/mark-completed', [App\Http\Controllers\Admin\UpcomingEventController::class, 'markCompleted'])->name('admin.upcoming-events.markCompleted');
    Route::post('upcoming-events/{upcomingEvent}/mark-cancelled', [App\Http\Controllers\Admin\UpcomingEventController::class, 'markCancelled'])->name('admin.upcoming-events.markCancelled');
    Route::post('upcoming-events/{upcomingEvent}/reschedule', [App\Http\Controllers\Admin\UpcomingEventController::class, 'reschedule'])->name('admin.upcoming-events.reschedule');

    // Activity Plans
    Route::resource('activity-plans', \App\Http\Controllers\Admin\ActivityPlanController::class, ['as' => 'admin'])->names('activity-plans');

    // Activity Plans Status Transitions
    Route::post('activity-plans/{activityPlan}/mark-not-achieved', [App\Http\Controllers\Admin\ActivityPlanController::class, 'markNotAchieved'])->name('admin.activity-plans.markNotAchieved');
    Route::post('activity-plans/{activityPlan}/mark-ongoing', [App\Http\Controllers\Admin\ActivityPlanController::class, 'markOngoing'])->name('admin.activity-plans.markOngoing');
    Route::post('activity-plans/{activityPlan}/mark-achieved', [App\Http\Controllers\Admin\ActivityPlanController::class, 'markAchieved'])->name('admin.activity-plans.markAchieved');

    // Sports Equipment
    Route::resource('sports-equipment', \App\Http\Controllers\Admin\SportsEquipmentController::class, ['as' => 'admin'])->names('sports-equipment');

    // Office Equipment
    Route::resource('office-equipment', \App\Http\Controllers\Admin\OfficeEquipmentController::class, ['as' => 'admin'])->names('office-equipment');

    // Students (admin-only routes moved to a dedicated middleware group below)

    // Subscription Plans
    Route::get('/plans', [\App\Http\Controllers\Admin\SubscriptionPlansController::class, 'index'])->name('admin.plans.index');
    Route::get('/plans/create', [\App\Http\Controllers\Admin\SubscriptionPlansController::class, 'create'])->name('admin.plans.create');
    Route::post('/plans', [\App\Http\Controllers\Admin\SubscriptionPlansController::class, 'store'])->name('admin.plans.store');
    Route::get('/plans/{plan}/edit', [\App\Http\Controllers\Admin\SubscriptionPlansController::class, 'edit'])->name('admin.plans.edit');
    Route::put('/plans/{plan}', [\App\Http\Controllers\Admin\SubscriptionPlansController::class, 'update'])->name('admin.plans.update');
    Route::delete('/plans/{plan}', [\App\Http\Controllers\Admin\SubscriptionPlansController::class, 'destroy'])->name('admin.plans.destroy');

});

// Expenses: allow accountant role alongside admin & super-admin
Route::middleware(['auth', 'role:admin|super-admin|accountant'])->prefix('admin')->group(function () {
    Route::get('/expenses', [\App\Http\Controllers\Admin\ExpensesController::class, 'index'])->name('admin.expenses.index');
    Route::get('/expenses/create', [\App\Http\Controllers\Admin\ExpensesController::class, 'create'])->name('admin.expenses.create');
    Route::post('/expenses', [\App\Http\Controllers\Admin\ExpensesController::class, 'store'])->name('admin.expenses.store');
    Route::get('/expenses/{expense}/edit', [\App\Http\Controllers\Admin\ExpensesController::class, 'edit'])->name('admin.expenses.edit');
    Route::put('/expenses/{expense}', [\App\Http\Controllers\Admin\ExpensesController::class, 'update'])->name('admin.expenses.update');
    Route::patch('/expenses/{expense}/approve', [\App\Http\Controllers\Admin\ExpensesController::class, 'approve'])->name('admin.expenses.approve');
    Route::patch('/expenses/{expense}/reject', [\App\Http\Controllers\Admin\ExpensesController::class, 'reject'])->name('admin.expenses.reject');
    Route::patch('/expenses/{expense}/mark-paid', [\App\Http\Controllers\Admin\ExpensesController::class, 'markPaid'])->name('admin.expenses.mark-paid');
    Route::delete('/expenses/{expense}', [\App\Http\Controllers\Admin\ExpensesController::class, 'destroy'])->name('admin.expenses.destroy');
});

Route::middleware(['auth', 'role:admin|super-admin'])->prefix('admin')->group(function () {
    // Equipment Management
    // (moved below) Expenses routes now allow accountant role

    // Equipment Management
    Route::get('/equipment', [\App\Http\Controllers\Admin\EquipmentController::class, 'index'])->name('admin.equipment.index');
    Route::get('/equipment/create', [\App\Http\Controllers\Admin\EquipmentController::class, 'create'])->name('admin.equipment.create');
    Route::post('/equipment', [\App\Http\Controllers\Admin\EquipmentController::class, 'store'])->name('admin.equipment.store');
    Route::get('/equipment/{equipment}', [\App\Http\Controllers\Admin\EquipmentController::class, 'show'])->name('admin.equipment.show');
    Route::get('/equipment/{equipment}/edit', [\App\Http\Controllers\Admin\EquipmentController::class, 'edit'])->name('admin.equipment.edit');
    Route::put('/equipment/{equipment}', [\App\Http\Controllers\Admin\EquipmentController::class, 'update'])->name('admin.equipment.update');
    Route::delete('/equipment/{equipment}', [\App\Http\Controllers\Admin\EquipmentController::class, 'destroy'])->name('admin.equipment.destroy');

    // Branches Management
    Route::get('/branches', [\App\Http\Controllers\Admin\BranchesController::class, 'index'])->name('admin.branches.index');
    Route::get('/branches/create', [\App\Http\Controllers\Admin\BranchesController::class, 'create'])->name('admin.branches.create');
    Route::post('/branches', [\App\Http\Controllers\Admin\BranchesController::class, 'store'])->name('admin.branches.store');
    Route::get('/branches/{branch}', [\App\Http\Controllers\Admin\BranchesController::class, 'show'])->name('admin.branches.show');
    Route::get('/branches/{branch}/edit', [\App\Http\Controllers\Admin\BranchesController::class, 'edit'])->name('admin.branches.edit');
    Route::put('/branches/{branch}', [\App\Http\Controllers\Admin\BranchesController::class, 'update'])->name('admin.branches.update');
    Route::delete('/branches/{branch}', [\App\Http\Controllers\Admin\BranchesController::class, 'destroy'])->name('admin.branches.destroy');

    // Note: Groups Management routes are defined at the top using Route::resource('groups', ...)

    // Super-admin only: Roles & Permissions management
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/roles', [\App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('admin.roles.index');
        Route::get('/roles/{role}/edit', [\App\Http\Controllers\Admin\RolePermissionController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/roles/{role}', [\App\Http\Controllers\Admin\RolePermissionController::class, 'update'])->name('admin.roles.update');

        Route::post('/permissions', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storePermission'])->name('admin.permissions.store');
        // Role creation / deletion
        Route::get('/roles/create', [\App\Http\Controllers\Admin\RolePermissionController::class, 'create'])->name('admin.roles.create');
        Route::post('/roles', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storeRole'])->name('admin.roles.store');
        Route::delete('/roles/{role}', [\App\Http\Controllers\Admin\RolePermissionController::class, 'destroy'])->name('admin.roles.destroy');

        // User-role assignment
        Route::get('/roles/assign', [\App\Http\Controllers\Admin\RolePermissionController::class, 'assignUserForm'])->name('admin.roles.assignForm');
        Route::post('/roles/assign', [\App\Http\Controllers\Admin\RolePermissionController::class, 'assignUserUpdate'])->name('admin.roles.assign');
    });
});


// Legacy students CRUD removed; using students-modern resource instead

// Modern Student CRUD (scaffolded with Tailwind + components)
Route::middleware(['auth'])->group(function () {
    Route::resource('students-modern', \App\Http\Controllers\StudentController::class);
    // Re-send registration confirmation email
    Route::post('students-modern/{student}/send-confirmation', [\App\Http\Controllers\Email\StudentRegistrationController::class, 'send'])->name('students-modern.send-confirmation');
});

// Backward-compatible aliases for legacy admin student URLs
Route::middleware(['auth', 'role:admin|super-admin'])
    ->prefix('admin')
    ->group(function () {
        // Index and create
        Route::get('/students', function () {
            return redirect()->route('students-modern.index');
        })->name('admin.students.index');
        Route::get('/students/create', function () {
            return redirect()->route('students-modern.create');
        })->name('admin.students.create');

        // Store
        Route::post('/students', function () {
            return redirect()->route('students-modern.store');
        })->name('admin.students.store');

        // Show, edit, update, destroy
        Route::get('/students/{student}', function ($student) {
            return redirect()->route('students-modern.show', $student);
        })->name('admin.students.show');
        Route::get('/students/{student}/edit', function ($student) {
            return redirect()->route('students-modern.edit', $student);
        })->name('admin.students.edit');
        Route::put('/students/{student}', function ($student) {
            return redirect()->route('students-modern.update', $student);
        })->name('admin.students.update');
        Route::patch('/students/{student}', function ($student) {
            return redirect()->route('students-modern.update', $student);
        })->name('admin.students.updatePartial');
        Route::delete('/students/{student}', function ($student) {
            return redirect()->route('students-modern.destroy', $student);
        })->name('admin.students.destroy');
    });

// Role-based dashboards
Route::middleware(['auth', 'role:coach|admin|super-admin'])->prefix('coach')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\CoachController::class, 'index'])->name('coach.dashboard');
    // Attendance management
    Route::get('/attendance', [\App\Http\Controllers\Coach\AttendanceController::class, 'index'])->name('coach.attendance.index');
    Route::get('/attendance/session/{session}', [\App\Http\Controllers\Coach\AttendanceController::class, 'show'])->name('coach.attendance.show');
    Route::post('/attendance/session/{session}', [\App\Http\Controllers\Coach\AttendanceController::class, 'store'])->name('coach.attendance.store');
    // Session scheduling
    Route::get('/sessions', [\App\Http\Controllers\Coach\SessionController::class, 'index'])->name('coach.sessions.index');
    Route::get('/sessions/create', [\App\Http\Controllers\Coach\SessionController::class, 'create'])->name('coach.sessions.create');
    Route::post('/sessions', [\App\Http\Controllers\Coach\SessionController::class, 'store'])->name('coach.sessions.store');
    Route::get('/sessions/{session}', [\App\Http\Controllers\Coach\SessionController::class, 'show'])->name('coach.sessions.show');
    Route::get('/sessions/{session}/edit', [\App\Http\Controllers\Coach\SessionController::class, 'edit'])->name('coach.sessions.edit');
    Route::put('/sessions/{session}', [\App\Http\Controllers\Coach\SessionController::class, 'update'])->name('coach.sessions.update');
    Route::delete('/sessions/{session}', [\App\Http\Controllers\Coach\SessionController::class, 'destroy'])->name('coach.sessions.destroy');
    // Coach students routes removed; coaches should use students-modern or dedicated attendance pages
    // Equipment (view only)
    Route::get('/equipment', [\App\Http\Controllers\Admin\EquipmentController::class, 'index'])->name('coach.equipment.index');
    Route::get('/equipment/{equipment}', [\App\Http\Controllers\Admin\EquipmentController::class, 'show'])->name('coach.equipment.show');
});

Route::middleware(['auth', 'role:accountant|admin|super-admin'])->prefix('accountant')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AccountantController::class, 'index'])->name('accountant.dashboard');
    // Dashboard metrics endpoint for charts
    Route::get('/dashboard/metrics', [\App\Http\Controllers\AccountantController::class, 'metrics'])->name('accountant.dashboard.metrics');

    // Subscriptions
    Route::get('/subscriptions', [\App\Http\Controllers\Accountant\SubscriptionsController::class, 'index'])->name('accountant.subscriptions.index');
    Route::get('/subscriptions/create', [\App\Http\Controllers\Accountant\SubscriptionsController::class, 'create'])->name('accountant.subscriptions.create');
    Route::post('/subscriptions', [\App\Http\Controllers\Accountant\SubscriptionsController::class, 'store'])->name('accountant.subscriptions.store');
    Route::get('/subscriptions/{subscription}/edit', [\App\Http\Controllers\Accountant\SubscriptionsController::class, 'edit'])->name('accountant.subscriptions.edit');
    Route::get('/subscriptions/{subscription}', [\App\Http\Controllers\Accountant\SubscriptionsController::class, 'show'])->name('accountant.subscriptions.show');
    Route::put('/subscriptions/{subscription}', [\App\Http\Controllers\Accountant\SubscriptionsController::class, 'update'])->name('accountant.subscriptions.update');
    Route::delete('/subscriptions/{subscription}', [\App\Http\Controllers\Accountant\SubscriptionsController::class, 'destroy'])->name('accountant.subscriptions.destroy');

    // Payments
    Route::get('/payments', [\App\Http\Controllers\Accountant\PaymentsController::class, 'index'])->name('accountant.payments.index');
    Route::get('/payments/create', [\App\Http\Controllers\Accountant\PaymentsController::class, 'create'])->name('accountant.payments.create');
    Route::post('/payments', [\App\Http\Controllers\Accountant\PaymentsController::class, 'store'])->name('accountant.payments.store');
    Route::get('/payments/{payment}', [\App\Http\Controllers\Accountant\PaymentsController::class, 'show'])->name('accountant.payments.show');
    Route::get('/payments/export', [\App\Http\Controllers\Accountant\PaymentsController::class, 'export'])->name('accountant.payments.export');

    // Invoices
    Route::get('/invoices', [\App\Http\Controllers\Accountant\InvoicesController::class, 'index'])->name('accountant.invoices.index');
    Route::get('/invoices/create', [\App\Http\Controllers\Accountant\InvoicesController::class, 'create'])->name('accountant.invoices.create');
    Route::post('/invoices', [\App\Http\Controllers\Accountant\InvoicesController::class, 'store'])->name('accountant.invoices.store');
    Route::get('/invoices/{invoice}/edit', [\App\Http\Controllers\Accountant\InvoicesController::class, 'edit'])->name('accountant.invoices.edit');
    Route::put('/invoices/{invoice}', [\App\Http\Controllers\Accountant\InvoicesController::class, 'update'])->name('accountant.invoices.update');
    Route::delete('/invoices/{invoice}', [\App\Http\Controllers\Accountant\InvoicesController::class, 'destroy'])->name('accountant.invoices.destroy');

    // Equipment (view only)
    Route::get('/equipment', [\App\Http\Controllers\Admin\EquipmentController::class, 'index'])->name('accountant.equipment.index');
    Route::get('/equipment/{equipment}', [\App\Http\Controllers\Admin\EquipmentController::class, 'show'])->name('accountant.equipment.show');
});

Route::middleware(['auth', 'role:parent|admin|super-admin'])->prefix('parent')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ParentController::class, 'index'])->name('parent.dashboard');
    Route::get('/child/{student}/payments', [\App\Http\Controllers\ParentController::class, 'childPayments'])->name('parent.child-payments');
});

// Payment gateway webhooks (public routes - no auth)
Route::post('/webhooks/flutterwave', [\App\Http\Controllers\WebhooksController::class, 'flutterwave'])->name('webhooks.flutterwave');
Route::post('/webhooks/stripe', [\App\Http\Controllers\WebhooksController::class, 'stripe'])->name('webhooks.stripe');

require __DIR__.'/auth.php';

// Staff module routes (profiles, capacity building, attendances, communications, tasks)
require __DIR__.'/staff.php';

// CEO dashboard
Route::middleware(['auth', 'role:CEO|admin|super-admin'])->prefix('ceo')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\CeoController::class, 'index'])->name('ceo.dashboard');
});

// Communications admin CRUD
Route::middleware(['auth', 'role:admin|super-admin|CEO|Technical Director'])->prefix('admin')->group(function () {
    Route::resource('communications', \App\Http\Controllers\Admin\CommunicationController::class, ['as' => 'admin'])->only(['index','create','store','show','destroy']);
});

// Capacity Building admin CRUD
Route::middleware(['auth', 'role:admin|super-admin'])->prefix('admin')->group(function () {
    Route::resource('capacity-buildings', \App\Http\Controllers\Admin\CapacityBuildingController::class, ['as' => 'admin']);
    // Stats
    Route::get('/capacity-buildings/stats', [\App\Http\Controllers\Admin\CapacityBuildingController::class, 'stats'])->name('admin.capacity-buildings.stats');
    Route::get('/capacity-buildings/stats/export', [\App\Http\Controllers\Admin\CapacityBuildingController::class, 'exportStats'])->name('admin.capacity-buildings.stats.export');
});

// Training Session Records admin CRUD - allow coaches as well
Route::middleware(['auth', 'role:admin|super-admin|coach'])->prefix('admin')->group(function () {
    Route::get('training_session_records/{training_session_record}/prepare', [\App\Http\Controllers\Admin\TrainingSessionRecordController::class, 'prepare'])->name('admin.training_session_records.prepare');
    Route::get('training_session_records/{training_session_record}/report', [\App\Http\Controllers\Admin\TrainingSessionRecordController::class, 'report'])->name('admin.training_session_records.report');
    Route::resource('training_session_records', \App\Http\Controllers\Admin\TrainingSessionRecordController::class, ['as' => 'admin']);
});

// Staff Attendance admin CRUD - allow coaches
Route::middleware(['auth', 'role:admin|super-admin|coach'])->prefix('admin')->group(function () {
    Route::resource('staff_attendances', \App\Http\Controllers\Admin\StaffAttendanceController::class, ['as' => 'admin']);
});

// Students management: fully accessible to all authenticated users
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/students', function () { return redirect()->route('students-modern.index'); })->name('admin.students.index');
    Route::get('/students/{student}', function ($student) { return redirect()->route('students-modern.show', $student); })->name('admin.students.show');
    Route::get('/students/{student}/attendance', function ($student) { return redirect()->route('students-modern.show', $student); })->name('admin.students.attendance');
    Route::get('/students/{student}/attendance/export', function ($student) { return redirect()->route('students-modern.show', $student); })->name('admin.students.attendance.export');
    Route::get('/students/create', function () { return redirect()->route('students-modern.create'); })->name('admin.students.create');
    Route::post('/students', function () { return redirect()->route('students-modern.store'); })->name('admin.students.store');
    Route::get('/students/{student}/edit', function ($student) { return redirect()->route('students-modern.edit', $student); })->name('admin.students.edit');
    Route::put('/students/{student}', function ($student) { return redirect()->route('students-modern.update', $student); })->name('admin.students.update');
    Route::delete('/students/{student}', function ($student) { return redirect()->route('students-modern.destroy', $student); })->name('admin.students.destroy');
    Route::get('/students/import/photos', function () { return redirect()->route('students-modern.index'); })->name('admin.students.importForm');
    Route::post('/students/import/photos', function () { return redirect()->route('students-modern.index'); })->name('admin.students.importProcess');
});

// Local-only helper to grant admin role to current user for development
if (app()->environment('local')) {
    Route::middleware(['auth'])->get('/dev/make-me-admin', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user) abort(403);
        if (method_exists($user, 'assignRole')) {
            $user->assignRole('admin');
        }
        return redirect()->route('admin.dashboard')->with('status', 'You are now an admin');
    })->name('dev.makeMeAdmin');
}
