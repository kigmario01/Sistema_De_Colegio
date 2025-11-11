<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $query = Student::query()->with(['enrollments.academicPeriod', 'grades', 'attendances']);

        if ($search = request('search')) {
            $query->where(function ($q) use ($search): void {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('document_number', 'like', "%{$search}%");
            });
        }
        if ($grade = request('grade')) {
            $query->where('current_grade', $grade);
        }

        return StudentResource::collection($query->paginate());
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());

        return (new StudentResource($student))->response()->setStatusCode(201);
    }

    public function show(Student $student): StudentResource
    {
        $student->load(['enrollments.classroom', 'grades.subject', 'attendances']);

        return new StudentResource($student);
    }

    public function update(UpdateStudentRequest $request, Student $student): StudentResource
    {
        $student->update($request->validated());

        return new StudentResource($student);
    }

    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json([], 204);
    }
}
