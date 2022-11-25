<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;

    CONST PUBLISHED=1;
    CONST ARCHIVED=2;
    CONST DRAFT=3;

    protected $fillable = [
        'name',
        'slug',
    ];
}
