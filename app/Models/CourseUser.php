<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseUser extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public function user() {

        return $this->hasMany(User::class);
    }

    public function course() {

        return $this->hasMany(Course::class);
    }
}

