<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index(User $user) {

        $courses = Course::visibleto(Auth::user())
                        ->published()
                        ->whereDoesntHave('enrollments', function (Builder $query) use($user) {
                            $query->where('user_id', $user->id);
                        })
                        ->get();
        return view ('enrollments.enrollCourse', [
            'user' => $user,
            'courses' => $courses,
            'enrolledCourses' => $user->enrollments()->get()  
        ]);
    }

    public function store(Request $request, User $user) {

        if ($user->is_employee) {

            return to_route('users')
                            ->with('unsuccess', 'Only Employees can access a course');
        }
        else {

            $attributes = $request->validate ([
                'courseIds' => [
                    'required',
                    'array',
                    'min:1',
                    Rule::in(Course::visibleto(Auth::user())
                    ->published()
                    ->whereDoesntHave('enrollments', function (Builder $query) use($user) {
                        $query->where('user_id', $user->id);
                    })
                    ->get()
                    ->pluck('id')
                    ->toArray()
                )],  
            ]);
            
            $user->enrollments()->attach($attributes['courseIds']);
            
            return back()->with('success', 'Course Enrolled Successfully');
        }
    }

    public function delete(User $user, Course $enrolledCourse) {

        $user->enrollments()->detach($enrolledCourse->id);

        return back()->with('unsuccess', 'Course Unenrolled Successfully');;
        
    }
}
