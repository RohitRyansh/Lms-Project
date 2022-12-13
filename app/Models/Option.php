<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option',
        'answer'
    ];

    public function question() {
        
        return $this->belongsTo(Question::class);
    }

    public function scopeTrueAnswers($query, Question $question) {
        
        return $query->where('question_id', $question->id)
            ->where('answer', true)->first();
    }
}
