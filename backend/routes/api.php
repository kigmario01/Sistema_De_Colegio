<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('classrooms', ClassroomController::class);
    Route::apiResource('attendances', AttendanceController::class)->only(['index', 'store', 'update']);
    Route::apiResource('grades', GradeController::class)->except(['destroy']);

    Route::get('reports/attendance/pdf', [ReportController::class, 'pdf']);
    Route::get('reports/attendance/excel', [ReportController::class, 'attendanceExcel']);
    Route::get('reports/grades/excel', [ReportController::class, 'excel']);
});
