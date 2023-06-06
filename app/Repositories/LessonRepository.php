<?php

namespace App\Repositories;

use App\Http\Requests\StoreUpdateLesson;
use App\Models\Lesson;
use App\Models\Module;

class LessonRepository
{
    protected Lesson $lesson;
    protected ModuleRepository $moduleRepository;
    public function __construct(Lesson $lesson,ModuleRepository $moduleRepository)
    {
        $this->moduleRepository=$moduleRepository;
        $this->lesson=$lesson;
    }
    public function getLessonsByModule(int $moduleId)
    {
        return $this->lesson->where('module_id',$moduleId)->get();
    }

    public function createNewLesson(array $validated,int $moduleId)
    {
        $validated['module_id'] = $moduleId;

        return $this->lesson->create($validated);
    }

    public function updateLessonByUuid($moduleId, array $validated, string $identify):void
    {
        $lesson = $this->getLessonByUuid($identify);
        $validated['module']=$moduleId;
        $lesson->update($validated);
    }

    public function getLessonByUuid(string $identify):Lesson
    {
        return $this->lesson
            ->where('uuid',$identify)
            ->firstOrFail();
    }

    public function deleteLessonByUuid(string $identify): ?bool
    {
        $lesson = $this->getLessonByUuid($identify);
        return $lesson->delete();
    }

}
