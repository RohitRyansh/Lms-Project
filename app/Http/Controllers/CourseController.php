<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseImage;
use App\Models\level;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index() {

        return view ('trainer.courses.index', [
            'levels' => level::get(),
            'categories' => Category::visibleto(Auth::user())
                ->active()
                ->get(),
            'courses' => Course::latest()
                ->visibleto(Auth::user())
                ->active()
                ->search (
                    request ([
                        'search',
                        'level',
                        'category',
                        'newest'
                        ]))
                ->get(),
            'statuses' => status::get()
        ]);
    }

    public function create() {

        return view ('trainer.courses.create', [
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
                    ->active()
                    ->get()
                    ->pluck('id')
                    ->toArray()
                    ),
                ],
                'image_path' => 'mimes:png,jpg,jpeg'
            ]
        );

        $attributes += [
            'status_id' => status::DRAFT,
            'user_id' => Auth::id()
        ];

        $image = $request
            ->file('image_path')
            ->store('/images');

        $course = Course::create($attributes);

        CourseImage::create ([
            'image_path' => $image,
            'course_id' => $course->id
            ]);
         
        return to_route ('courses')
            ->with('success', 'Course Created Successfully.');
    }

    public function view(Course $course) {

        return view ('trainer.courses.view', [
            'course' => $course
        ]);
    }

    public function edit(Course $course) {

        return view ('trainer.courses.edit', [
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
