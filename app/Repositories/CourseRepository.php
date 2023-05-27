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

}
