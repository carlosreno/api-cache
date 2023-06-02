<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected Module $module;
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    public function getModulesByCourse(int $courseId)
    {
        return $this->module->where('course_id',$courseId)->get();
    }

    public function createNewModule(array $validated,int $id)
    {
        $validated['course_id'] = $id;

        return $this->module->create($validated);
    }

    public function updateModuleByUuid($courseId, array $validated, string $identify): void
    {
        $module = $this->getModuleByUuid($identify);
        $validated['course']=$courseId;
        $module->update($validated);
    }

    public function getModuleByUuid(string $identify):Module
    {
        return $this->module
                ->where('uuid',$identify)
                ->firstOrFail();
    }

    public function deleteModuleByUuid(string $identify)
    {
        $module = $this->getModuleByUuid($identify);
        return $module->delete();
    }


}
