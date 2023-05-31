<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourse;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class CourseController extends Controller
{
    protected CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getCourses();
        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCourse $request): CourseResource
    {
        $course = $this->courseService->createNewCourse($request->validated());
        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $identify): CourseResource
    {
        $course = $this->courseService->getCourseByIdentify($identify);
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $identify)
    {
        $this->courseService->deleteCourse($identify);
        return response()->json([],204);
    }
}
