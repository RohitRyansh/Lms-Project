<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category_Demo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
        'parent_id',
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

    public function scopeActive($query) {

        return $query->where('status', true);
    }

    public function scopeVisibleTo($query) {
        
        return $query->where('owner_id', Auth::id());
    }
}
