<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index() {

        $courses = Course::whereHas('enrollments', function (Builder $query) {
                            $query->where('user_id', Auth::id());
                        })
                        ->published()
                        ->get();

        return view ('employees.index', [
            'Courses' => $courses
        ]);
    }
}
