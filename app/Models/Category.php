<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'email_status',
        'slug',
        'created_by'
    ];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]   
        ];
    }

    public function user() {
        
        return $this->belongsTo(User::class, 'created_by');
    }

    public function courses() {

        return $this->hasMany(Course::class);
    }

    public function course_unit() {

        return $this->hasManyThrough(CourseUnit::class, Course::class,'category_id','course_id','id','id');
    }

    public function scopeSearch($query,array $filter) {

        $query->when($filter['search'] ?? false, function($query, $search) {

            return $query
                ->where('name','like','%'. $search . '%')
                    ->orwhere('slug','like','%'. $search .'%');
        });

         $query->when($filter['newest'] ?? false, function($query) {

            return $query
                ->orderby('created_at','desc');
        });
    }
    
    public function scopeActive($query) {

        return $query->where('status', true);
    }

    public function scopeVisibleTo($query) {
        
        return $query->where('created_by', Auth::id());
    }
}
