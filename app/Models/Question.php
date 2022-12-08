<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestQuestion;
use App\Models\Test;



class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
    ];

    public function tests() {

    return $this->belongsToMany(Test::class ,'test_questions')
        ->withPivot('id')
        ->withTimestamps()
        ->using(TestQuestion::class);
    }

    public function options() {
        
        return $this->hasMany(Option::class);
    }
}
