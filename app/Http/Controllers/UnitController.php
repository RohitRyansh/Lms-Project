<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUnit;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    public function create(Course $course)
    {
        return view('units.create', [
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $attributes = $request->validate ([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5'
        ]);
       
        $unit = Unit::create($attributes);

        CourseUnit::create ([
            'course_id' => $course->id,
            'unit_id' => $unit->id
        ]);

        if ($request['save'] == 'save') {  

            return to_route('courses.units.edit', [$course, $unit])
                ->with('success', 'Unit Created Successfully.');
        }

        return back()->with('success', 'Unit Created Successfully.');
    }

    public function edit(Course $course, Unit $unit) {

        $this->authorize('update',$course);

        return view('units.edit', [
            'unit' => $unit,
            'course' => $course,
        ]);
    }

    public function update(Request $request, Course $course, Unit $unit) {

        $attributes = $request->validate ([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5'
        ]);

        $this->authorize('update',$course);

        $unit->update($attributes);

        return to_route('courses.view', $course)
            ->with('success', 'Unit Updated Successfully.');
    }

    public function delete(Course $course, Unit $unit) {

        $this->authorize('delete',$course);

        $unit->delete();

        return to_route('courses.view', $course)
            ->with('success', 'Unit Deleted Successfully.');
    }
}

