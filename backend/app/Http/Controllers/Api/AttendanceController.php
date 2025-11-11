<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $query = Attendance::query()
            ->with(['student', 'classroom', 'subject'])
            ->latest('date');

        if ($classroomId = request('classroom_id')) {
            $query->where('classroom_id', $classroomId);
        }
        if ($subjectId = request('subject_id')) {
            $query->where('subject_id', $subjectId);
        }
        if ($from = request('from')) {
            $query->whereDate('date', '>=', Carbon::parse($from));
        }
        if ($to = request('to')) {
            $query->whereDate('date', '<=', Carbon::parse($to));
        }

        $perPage = (int) request('per_page', 15);
        $collection = $perPage > 0 ? $query->paginate($perPage) : $query->get();

        if ($perPage > 0) {
            return AttendanceResource::collection($collection);
        }

        return AttendanceResource::collection($collection)->additional(['meta' => ['total' => $collection->count()]]);
    }

    public function store(StoreAttendanceRequest $request): JsonResponse
    {
        $attendance = Attendance::create($request->validated());

        return (new AttendanceResource($attendance->load(['student', 'classroom', 'subject'])))->response()->setStatusCode(201);
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance): AttendanceResource
    {
        $attendance->update($request->validated());

        return new AttendanceResource($attendance->load(['student', 'classroom', 'subject']));
    }
}
