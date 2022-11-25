<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index(Course $course) {

        $users = User::active()
                        ->employee()
                        ->visibleto(Auth::user())
                        ->whereDoesntHave('enrollments', function (Builder $query) use($course) {
                            $query->where('course_id', $course->id);
                        })
                        ->get();

        return view ('enrollments.index', [
            'users' => $users,
            'course' => $course,
            'enrolledUsers' => $course->enrollments()->get()  
        ]);
    }

    public function store(Request $request, Course $course) {

        $attributes = $request->validate ([
            'user_ids' => ['required',
            Rule::in(User::active()
                ->employee()
                ->visibleto(Auth::user())
                ->whereDoesntHave('enrollments', function (Builder $query) use($course) {
                    $query->where('course_id', $course->id);
                })
                ->get()
                ->pluck('id')
                ->toArray()
            )],  
        ]);

        $course->enrollments()->attach($attributes['user_ids']);

        return back();
    }

    public function delete(Course $course, User $enrolledUser) {

        $course->enrollments()->detach($enrolledUser->id);

        return back();
        
    }
}
