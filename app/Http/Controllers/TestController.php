<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\Unit;
use Illuminate\Http\Request;
//WIP
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

        return back()->with('success', 'Test Created Successfully.');

    }
}
