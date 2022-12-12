<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class LearnerTestController extends Controller
{
    public function index(Unit $unit) {

        return view ('employees.tests.index', [
            'unit' => $unit
        ]);
    }
}
