<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'category_id',
        'status_id',
        'level_id',
        'user_id',
        'slug',
        'title',
        'description',
        'certificate'
    ];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => ['title']
        ]];
    }

    public function user() {
        
        return $this->belongsTo(User::class);
    }

    public function category() {
        
        return $this->belongsTo(Category::class);
    }

    public function level() {
        
        return $this->belongsTo(level::class);
    }

    public function status() {
        
        return $this->belongsTo(status::class);
    }

    public function units() {
        
        return $this->belongsToMany(Unit::class, 'course_units');
    }

    public function enrollments() {

        return $this->belongsToMany(User::class)
        ->withPivot('id')
        ->withTimestamps()
        ->using(CourseUser::class);
    }
    
    public function scopeSearch($query, array $filter) {

        $query->when($filter['search'] ?? false, function($query, $search) {

            return $query
                ->where('slug', 'like', '%'. $search . '%')
                    ->orwhere('title', 'like', '%'. $search . '%');
        });

        $query->when($filter['category'] ?? false, function($query, $search) {

            return $query
                ->where('category_id', $search);
        });

        $query->when($filter['level'] ?? false, function($query, $search) {

            return $query
                ->where('level_id', $search);
        });   
    }

    public function scopeVisibleTo($query) {
        
        return $query->where('user_id', Auth::id());
    }

    public function scopeActive($query) {

        return $query->where('category_id', Category::visibleTo(Auth::user())
                                                        ->active()
                                                        ->pluck('id')
                                                        ->toArray()
                                                    );
    }

    public function scopePublished($query) {
        
        return $query->where('status_id', status::PUBLISHED);
    }

}


