<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;

class CourseService
{
    protected CourseRepository $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository =$courseRepository;
    }

    public function getCourses()
    {
        return $this->courseRepository->getAllCourses();
    }

    public function createNewCourse(array $data)
    {
        return $this->courseRepository->createNew($data);
    }
    public function getCourseByIdentify(string $identify): Course
    {
        return $this->courseRepository->getCourseByUUID($identify);
    }

    public function deleteCourse(string $identify)
    {
        return $this->courseRepository->deleteByUuid($identify);
    }


}
