<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Module;
use App\Repositories\{
    CourseRepository,
    ModuleRepository
};
use http\Params;


class ModuleService
{
    protected ModuleRepository $moduleRepository;
    protected CourseRepository $courseRepository;
    public function __construct(
        ModuleRepository $moduleRepository,
        CourseRepository $courseRepository
    )
    {
        $this->moduleRepository =$moduleRepository;
        $this->courseRepository =$courseRepository;
    }

    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUUID($course);
        return $this->moduleRepository->getModulesByCourse($course->id);
    }

    public function createNewModule(array $validated): Module
    {
        $courseId = $this->courseRepository->getCourseByUUID($validated['course'])->id;
        return $this->moduleRepository->createNewModule($validated,$courseId);
    }

    public function getModuleByCourse(string $identify): Module
    {
        return $this->moduleRepository->getModuleByUuid($identify);
    }
    public function updateModule(string $identify, array $validated)
    {
        $courseId = $this->courseRepository->getCourseByUUID($validated['course'])->id;
        return $this->moduleRepository->updateModuleByUuid($courseId,$validated,$identify);
    }

    public function deleteModule(string $identify)
    {
        return $this->moduleRepository->deleteModuleByUuid($identify);
    }




}
