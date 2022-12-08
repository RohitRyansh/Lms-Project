<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;
//Wip
class TestController extends Controller
{
    public function create(Course $course, Unit $unit)
    {
        return view('trainer.courses.tests.create', [
            'course' => $course,
            'unit' => $unit
        ]);
    }

    public function store(Request $request, Course $course, Unit $unit)
    {
        $attributes = $request->validate ([
            'name' => 'required|string|min:3|max:255',
            'duration' => 'required|numeric|gt:0',
            'pass_score' => 'required|numeric|between:1,100'
        ]);

        $attributes += [
            'unit_id' => $unit->id
        ];

        $test = Test::create($attributes);

        $test->lessons()->create([
            'unit_id' => $unit->id,
            'duration' => $attributes['duration']
        ]);

        $unit->increment('duration', $attributes['duration']);

        if ($request['save'] == 'save') {

            return to_route('courses.units.tests.edit', [$course, $unit, $test])
                ->with('success', 'Test Created Successfully');
        }

        return back()->with('success', 'Test Created Successfully.');

    }

    public function edit(Course $course, Unit $unit, Test $test) {

        return view('trainer.courses.tests.edit', [
            'unit' => $unit,
            'course' => $course,
            'test' => $test
         ]);
    }

    public function update(Request $request, Course $course, Unit $unit, Test $test) {

        $attributes = $request->validate([
            'name' => 'required|min:3|max:255',
            'duration' => 'required|numeric',
            'pass_score' => 'required|numeric|gt:0'
        ]);

        $test->update($attributes);

        return to_route('courses.units.tests.edit', [$course, $unit, $test])
            ->with('success', 'Test Updated Successfully');
    }

    public function delete(Course $course, Unit $unit, Test $test) {

        $test->delete();

        return to_route('courses.units.tests.edit', [$course, $unit, $test])
            ->with('success', 'Test Deleted Successfully.');
    }  
}
