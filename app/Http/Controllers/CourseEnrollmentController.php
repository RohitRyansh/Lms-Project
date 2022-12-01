<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Notifications\CourseEnrollmentNotification;
use App\Notifications\EnrollmentNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class CourseEnrollmentController extends Controller
{
    public function index(Course $course) {

        $users = User::active()
                    ->employee()
                    ->visibleto(Auth::user())
                    ->whereDoesntHave('enrollments', function (Builder $query) use($course) {
                        $query->where('course_id', $course->id);
                    })
                    ->get();
                        
        return view ('trainer.courses.enrollment', [
            'users' => $users,
            'course' => $course,
            'enrolledUsers' => $course->enrollments()->get()  
        ]);
    }

    public function store(Request $request, Course $course) {

        $attributes = $request->validate ([
            'userIds' => [
                'required',
                'array',
                'min:1',
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

        $course->enrollments()->attach($attributes['userIds']);

        $user = User::find($attributes['userIds']);

        Notification::send($user, new CourseEnrollmentNotification(Auth::user(), $course));

        return back()->with('success', 'User Enrolled Successfully');
    }

    public function delete(Course $course, User $enrolledUser) {

        $course->enrollments()->detach($enrolledUser->id);

        return back()->with('unsuccess', 'User Unenrolled Successfully');;
        
    }
}
