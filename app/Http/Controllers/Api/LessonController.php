<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Services\CourseService;
use App\Services\LessonService;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class LessonController extends Controller
{
    protected LessonService $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }
    public function index(string $module)
    {
        $modules = $this->lessonService->getLessonsByModule($module);
        return LessonResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateLesson $request)
    {
        $module = $this->lessonService->createNewLesson($request->validated());
        return new LessonResource($module);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $module, string $identify)
    {
        $module = $this->lessonService->getLessonByModule($module, $identify);
        return new LessonResource($module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateLesson $request,string $module, string $identify): string
    {
        $this->lessonService->updateLesson($identify, $request->validated());
        return response()->json(['message'=>'updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $module, string $identify)
    {
        $this->lessonService->deleteLesson($identify);
        return response()->json([],204);
    }
}
