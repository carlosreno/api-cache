<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Str;


class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function creating(Course $course): void
    {
        $course->uuid = (string) Str::uuid();
    }
}
