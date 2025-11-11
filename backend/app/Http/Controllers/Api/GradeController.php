<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GradeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $grades = Grade::query()
            ->with(['student', 'subject', 'teacher'])
            ->paginate();

        return GradeResource::collection($grades);
    }

    public function store(StoreGradeRequest $request): JsonResponse
    {
        $grade = Grade::create($request->validated());

        return (new GradeResource($grade))->response()->setStatusCode(201);
    }

    public function show(Grade $grade): GradeResource
    {
        return new GradeResource($grade->load(['student', 'subject', 'teacher']));
    }

    public function update(UpdateGradeRequest $request, Grade $grade): GradeResource
    {
        $grade->update($request->validated());

        return new GradeResource($grade);
    }
}
