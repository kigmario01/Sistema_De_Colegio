<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeacherController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $teachers = Teacher::query()->with(['subjects', 'schedules'])->paginate();

        return TeacherResource::collection($teachers);
    }

    public function store(StoreTeacherRequest $request): JsonResponse
    {
        $teacher = Teacher::create($request->validated());
        if ($subjects = $request->input('subjects')) {
            $teacher->subjects()->sync($subjects);
        }

        return (new TeacherResource($teacher->load(['subjects', 'schedules'])))->response()->setStatusCode(201);
    }

    public function show(Teacher $teacher): TeacherResource
    {
        $teacher->load(['subjects', 'schedules.classroom']);

        return new TeacherResource($teacher);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): TeacherResource
    {
        $teacher->update($request->validated());
        if ($subjects = $request->input('subjects')) {
            $teacher->subjects()->sync($subjects);
        }

        return new TeacherResource($teacher->load(['subjects', 'schedules']));
    }

    public function destroy(Teacher $teacher): JsonResponse
    {
        $teacher->delete();

        return response()->json([], 204);
    }
}
