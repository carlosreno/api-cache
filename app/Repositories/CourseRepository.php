<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected Course $entity;
    public function __construct(Course $course)
    {
        $this->entity=$course;
    }

    public function getAllCourses()
    {
//        return Cache::remember('course',60,function (){
//            return $this->entity
//                ->with('modules.lesson')
//                ->get();
//        });
        return Cache::rememberForever('courses',function (){
            return $this->entity
                ->with('modules.lesson')
                ->get();
        });
    }

    public function createNew(array $data)
    {
        Cache::forget('courses');
        return $this->entity->create($data);
    }

    public function getCourseByUUID(string $identify)
    {
        return $this->entity->where('uuid',$identify)->with('modules.lesson')->firstOrFail();
    }

    public function deleteByUuid(string $identify)
    {
        $course = $this->getCourseByUUID($identify);
        Cache::forget('courses');
        return $course->delete();
    }

    public function updateByUuid(string $identify, array $validated)
    {
        $course = $this->getCourseByUUID($identify);
        Cache::forget('courses');
        return $course->update($validated);
    }


}
