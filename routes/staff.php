<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Admin\CapacityBuildingController;
use App\Http\Controllers\Staff\TrainingSessionRecordController;
use App\Http\Controllers\Staff\StaffAttendanceController;
use App\Http\Controllers\Staff\CommunicationController;
use App\Http\Controllers\Staff\StaffTaskController;

Route::middleware(['web','auth','verified'])->group(function () {
    Route::resource('staff', StaffController::class);
    Route::resource('capacity_buildings', CapacityBuildingController::class)->names('capacity_buildings');
    Route::resource('training_sessions', TrainingSessionRecordController::class)->names('training_sessions');
    Route::resource('attendances', StaffAttendanceController::class)->names('attendances');
    Route::resource('communications', CommunicationController::class)->only(['index','create','store','show','destroy'])->names('communications');
    Route::resource('tasks', StaffTaskController::class)->names('tasks');
});
