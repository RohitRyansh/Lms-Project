<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class LearnerUnitController extends Controller
{
    public function index(Course $course) {

        return view ('employees.units.index', [
            'course' => $course
        ]);
    }
}
