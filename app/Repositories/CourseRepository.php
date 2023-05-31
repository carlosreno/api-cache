<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected Course $entity;
    public function __construct(Course $course)
    {
        $this->entity=$course;
    }

    public function getAllCourses()
    {
        return $this->entity->get();
    }

    public function createNew(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUUID(string $identify)
    {
        return $this->entity->where('uuid',$identify)->firstOrFail();
    }

    public function deleteByUuid(string $identify)
    {
        $course = $this->getCourseByUUID($identify);
        return $course->delete();
    }


}
