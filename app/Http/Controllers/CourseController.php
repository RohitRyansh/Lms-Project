<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\level;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index() {

        return view ('courses.index', [
            'levels' => level::get(),
            'categories' => Category::visibleto(Auth::user())
            ->active()
            ->get(),
            'courses' => Course::latest()->search (
                request ([
                    'search',
                    'level',
                    'category'
                    ]))
                    ->visibleto(Auth::user())
                    ->get(),

        ]);
    }

    public function create() {

        return view ('courses.create', [
            'levels' =>  level::get(),
            'categories' => Category::visibleto(Auth::user())
            ->active()
            ->get(),
        ]);
    }

    public function store(Request $request) {

        $attributes = $request->validate ([
                'title' => 'required|string|min:3|max:255',
                'description' => 'required|string|min:5',
                'level_id' => 'required',
                'category_id' => ['required',
                Rule::in(Category::active()
                    ->visibleto(Auth::user())
                    ->get()
                    ->pluck('id')
                    ->toArray()
                )
            ],
        ]);

        $attributes += [

            'status_id' => status::PUBLISHED,
            'user_id' => Auth::id()
        ];

        Course::create($attributes);
         
        return to_route ('courses')
            ->with('success', 'Course Created Successfully.');
    }

    public function view(Course $course) {

        return view('courses.view', [
            'course' => $course
        ]);
    }

    public function edit(Course $course) {

        return view ('courses.edit', [
            'course' => $course,
            'levels' => level::get(),
            'categories' => Category::visibleto(Auth::user())
            ->active()
            ->get(),
        ]);
    }

    public function update(Request $request, Course $course) {
       
        $attributes = $request->validate ([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5',
            'level_id' => 'required',
            'category_id' => ['required',
                Rule::in (Category::active()
                    ->visibleTo(Auth::user())
                    ->get()
                    ->pluck('id')
                    ->toArray()
                )
            ],
        ]);

        $course->update($attributes);

        return to_route('courses')
            ->with('success', 'Course Updated Successfully.');
    }
}
