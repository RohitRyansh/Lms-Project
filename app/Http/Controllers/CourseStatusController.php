<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseStatusController extends Controller
{
    public function CourseStatus(Course $course)
    {
        $course->update([
            'status_id' => request('statusUpdate')
        ]);
        
        return to_route ('courses');
    }
}


