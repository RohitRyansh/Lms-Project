<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function questions() {

        return $this->belongsToMany(Question::class, 'test_questions')
        ->withPivot('id')
        ->withTimestamps()
        ->using(TestQuestion::class);
    }

    public function lessons() {
        return $this->morphMany(Lesson::class, 'lessonable');
    }
}
