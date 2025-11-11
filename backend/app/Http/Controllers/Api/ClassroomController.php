<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClassroomController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $classrooms = Classroom::query()->with(['academicPeriod', 'subjects'])->paginate();

        return ClassroomResource::collection($classrooms);
    }

    public function store(StoreClassroomRequest $request): JsonResponse
    {
        $classroom = Classroom::create($request->validated());
        if ($subjects = $request->input('subjects')) {
            $classroom->subjects()->sync($subjects);
        }

        return (new ClassroomResource($classroom->load(['academicPeriod', 'subjects'])))->response()->setStatusCode(201);
    }

    public function show(Classroom $classroom): ClassroomResource
    {
        $classroom->load(['academicPeriod', 'students', 'subjects']);

        return new ClassroomResource($classroom);
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom): ClassroomResource
    {
        $classroom->update($request->validated());
        if ($subjects = $request->input('subjects')) {
            $classroom->subjects()->sync($subjects);
        }

        return new ClassroomResource($classroom->load(['academicPeriod', 'subjects']));
    }

    public function destroy(Classroom $classroom): JsonResponse
    {
        $classroom->delete();

        return response()->json([], 204);
    }
}
