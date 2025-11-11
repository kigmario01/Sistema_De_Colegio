<?php

use App\Http\Controllers\Web\PublicReportController;
use Illuminate\Support\Facades\Route;

Route::get('/oferta-educativa', [PublicReportController::class, 'subjects'])->name('public.subjects');
Route::get('/docentes', [PublicReportController::class, 'teachers'])->name('public.teachers');
Route::get('/horarios', [PublicReportController::class, 'schedules'])->name('public.schedules');
