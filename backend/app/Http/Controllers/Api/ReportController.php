<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportExportService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function __construct(private readonly ReportExportService $exportService)
    {
    }

    public function pdf(Request $request): BinaryFileResponse
    {
        $path = $this->exportService->generateAttendancePdf(
            $request->integer('classroom_id'),
            $request->date('from'),
            $request->date('to')
        );

        return response()->download($path);
    }

    public function attendanceExcel(Request $request): BinaryFileResponse
    {
        $path = $this->exportService->generateAttendanceExcel(
            $request->integer('classroom_id'),
            $request->date('from'),
            $request->date('to')
        );

        return response()->download($path);
    }

    public function excel(Request $request): BinaryFileResponse
    {
        $path = $this->exportService->generateGradesExcel(
            $request->integer('classroom_id'),
            $request->integer('subject_id'),
            $request->integer('academic_period_id')
        );

        return response()->download($path);
    }
}
