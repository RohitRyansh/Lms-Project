<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryStatusController extends Controller
{
    public function CategoryStatus(Category $category) {

        if($category->status == true) {

            $attributes = [
                'status' => false
            ];

        } else {

            $attributes = [
                'status' => true
            ];
        }
        
        $category->update($attributes);
        
        return to_route('categories');
    }
}
