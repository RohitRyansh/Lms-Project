<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Course $course, Unit $unit, Test $test)
    {
        return view('trainer.courses.questions.create', [
            'course' => $course,
            'unit' => $unit,
            'test' => $test
        ]);
    }

    public function store(Request $request, Course $course, Unit $unit, Test $test)
    {

        $attributes = $request->validate ([
            'question' => 'required|min:3|max:255',
            'options' => 'array|size:4',
            'options.*' => 'required|min:3|max:255',
            'answer' => 'required|gt:0'
        ]);

        $question = Question::create ([
            'question' => $attributes['question']
        ]);

        $question->tests()->attach($test);

        $i = 0;

    collect($attributes['options'])
            ->each(function ($option) use($question, &$i, $attributes) {

                $answer = Option::create ([
                    'option' => $option,
                    'question_id' => $question->id,
                ]);

                $i++;

                if ($i == $attributes['answer']) {
                    $answer->update([
                        'answer' => true
                    ]);
                }
            }
        );

        if ($request['save'] == 'save') {

            return to_route('tests.questions.edit', [$course, $unit, $test, $question])
                ->with('success', 'Question Created Successfully');
        }

        return back()->with('success', 'Question Created Successfully.');

    }

    public function edit(Course $course, Unit $unit, Test $test, Question $question) {

        return view('trainer.courses.questions.edit', [
            'unit' => $unit,
            'course' => $course,
            'test' => $test,
            'question' => $question
         ]);
    }

    public function update(Request $request, Course $course, Unit $unit, Test $test, Question $question) {

        $attributes = $request->validate ([
            'question' => 'required|min:3|max:255',
            'options' => 'array|size:4',
            'options.*' => 'required|min:3|max:255',
            'answer' => 'required'
        ]);

        $question->update([
            'question' => $attributes['question']
        ]);

        $i = 0;

        $question->options()
            ->each(function ($option) use( &$i, $attributes) {

                if ($i == $attributes['answer']) {
                    $option->update([
                        'option' => $attributes['options'][$i],
                        'answer' => true
                    ]);
                } else {

                    $option->update([
                        'option' => $attributes['options'][$i],
                        'answer' => false
                    ]);
                }
            $i++;
            }
        );

        return to_route('tests.questions.edit', [$course, $unit, $test, $question])
            ->with('success', 'Question Updated Successfully');
    }

    public function delete(Question $question)
    {
        $question->delete();

        return back()->with('success', 'Question Deleted Successfully');
    }

}
