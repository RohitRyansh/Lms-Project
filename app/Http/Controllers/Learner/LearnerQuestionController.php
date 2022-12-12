<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
//wip
class LearnerQuestionController extends Controller
{
    public function index(Test $test) {
    

        return view ('employees.questions.index', [
            'test' => $test,
            'questions' => $test->questions()->simplePaginate(1)
        ]);
    }

    public function next(Request $request,Question $question) {


    
    
    }
    
    public function check(Request $request, Test $test, Question $question) {


        dd(Option::where('option',$request->answer[0]))->get();
        if (Option::where('question_id', $question['id'],$request->answer[0], true)) {
            dd('giiii');
    }
        $attributes = $request->validate([
            'answer' => 'required'
        ]);
    }
}
