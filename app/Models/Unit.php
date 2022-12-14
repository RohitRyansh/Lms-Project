<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'slug'
    ];

    public function sluggable(): array {

        return [
            'slug' => [
                'source' => ['title']
        ]];
    }

    public function tests() {
        return $this->hasMany(Test::class);
    }
}

