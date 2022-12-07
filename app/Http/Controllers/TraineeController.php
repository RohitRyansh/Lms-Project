<?php

namespace App\Http\Controllers;

use App\Models\Category_Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraineeController extends Controller
{
    public function index() {

        return view ('demo.category.index', [
            'categories' => Category_Demo::visibleto(Auth::user())->get()
        ]);
    }

    public function edit(Category_Demo $category) {

        return view ('demo.category.edit', [
            'category' => $category
        ]);
        
    }

    public function update(Request $request ,Category_Demo $category) {

        $attributes = $request->validate ([
            'name' => ['required',
                'string',
                'min:3',
                'max:255'
            ],
        ]);

        $category->update($attributes);

        return to_route('trainee.index')
            ->with('success', 'Category Updated Successfully.');
    }

    public function push(Category_Demo $category) {
        
        $category->where('parent_id', $category->id)
            ->update ([
                'name' => $category->name
            ]);

        return to_route('trainee.index')
            ->with('success', 'Categories Updated Successfully.');
    }

    public function delete(Category_Demo $category) {

        $category->delete();

        return to_route('trainee.index')
            ->with('success', 'Category Deleted Successfully.');

    }
}
