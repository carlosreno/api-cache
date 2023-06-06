<?php

namespace App\Services;

use App\Http\Requests\StoreUpdateLesson;
use App\Models\Lesson;
use App\Models\Module;
use App\Repositories\LessonRepository;
use App\Repositories\ModuleRepository;
use PhpParser\Node\Expr\Array_;
use Ramsey\Collection\Collection;

class LessonService
{
    protected LessonRepository $lessonRepository;
    protected ModuleRepository $moduleRepository;
    public function __construct(LessonRepository $lessonRepository, ModuleRepository $moduleRepository)
    {
        $this->lessonRepository = $lessonRepository;
        $this->moduleRepository=$moduleRepository;
    }

    public function getLessonsByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);
        return $this->lessonRepository->getLessonsByModule($module->id);
    }

    public function createNewLesson(array $validated): Lesson
    {
        $moduleId = $this->moduleRepository->getModuleByUuid($validated['module'])->id;
        return $this->lessonRepository->createNewLesson($validated,$moduleId);
    }

    public function getLessonByModule(string $module,string $identify): Module
    {
        $moduleId = $this->moduleRepository->getModuleByUuid($module);
        return $this->moduleRepository->getModuleByUuid($identify,$moduleId);
    }
    public function updateLesson(string $identify, array $validated): void
    {

        $module = $this->moduleRepository->getModuleByUuid($validated['module']);

        $this->lessonRepository->updateLessonByUuid($module->id,$validated,$identify);
    }

    public function deleteLesson(string $identify): ?bool
    {
        return $this->moduleRepository->deleteModuleByUuid($identify);
    }

}
