<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'user_id',
        'total_marks',
        'correct_answer',
        'incorrect_answer'
    ];
}
