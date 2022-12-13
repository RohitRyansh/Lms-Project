<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestSession;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LearnerQuestionController extends Controller
{

    public function index(Unit $unit , Test $test) {

        return view ('employees.questions.index', [
            'test' => $test,
            'question' => $test->questions()->first(),
            'unit' => $unit,
            'last_question' => $test->questions()
                ->orderby('id', 'desc')
                ->first()
        ]);
    }
    
    public function check(Request $request, Unit $unit, Test $test, Question $question) {

        $attributes = $request->validate([
            'answer' => 'required'
        ]);

        $answer = Option::where('question_id', $question->id)
            ->where('answer', true)->first();
            
        if ($request['next'] == 'next') { 

            if ($answer->option == $attributes['answer'][0]) {

                if(Session::has('correct_answer')) {

                    Session::put('correct_answer', Session::get('correct_answer')+1);
                    
                } else {

                    Session::put('correct_answer', 1);
                }
            }

            $next_question = $question->where('id', '>', $question->id)->first();

            return view ('employees.questions.index', [
                'test' => $test,
                'question' => $next_question,
                'unit' => $unit,
                'last_question' => $test->questions()
                    ->orderby('id', 'desc')
                    ->first()
            ]);

        } else {

            if ($answer->option == $attributes['answer'][0]) {

                if(Session::has('correct_answer')) {

                    Session::put('correct_answer', Session::get('correct_answer')+1);
                   
                } else {
                    
                    Session::put('correct_answer', 1);
                }
            }

            $marks = 100/$test->questions()->count();

            $total_marks = Session::get('correct_answer')*$marks;

            $incorrect_answer = $test->questions()->count() - Session::get('correct_answer');

            TestSession::create([
                    'test_id' => $test->id,
                    'user_id' => Auth::id(),
                    'total_marks' => $total_marks,
                    'correct_answer' => Session::get('correct_answer'),
                    'incorrect_answer' => $incorrect_answer
            ]);
            
            Session::forget('correct_answer');

            return to_route('employee.units.tests.index', $unit)
                ->with('success', 'Test Attempt Successfully !');
        }
    }

}
