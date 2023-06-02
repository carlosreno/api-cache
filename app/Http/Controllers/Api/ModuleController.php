<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourse;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\ModuleResource;
use App\Models\Course;
use App\Models\Module;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;
use Ramsey\Collection\Collection;

class ModuleController extends Controller
{
    protected ModuleService $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index(string $course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);
        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateModule $request)
    {
        $module = $this->moduleService->createNewModule($request->validated());
        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $course, string $identify)
    {
        $module = $this->moduleService->getModuleByCourse($course, $identify);
        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCourse $request,string $course, string $identify): string
    {
        $this->moduleService->updateModule($identify, $request->validated());
        return response()->json(['message'=>'updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, string $identify)
    {
        $this->moduleService->deleteModule($identify);
        return response()->json([],204);
    }

}
