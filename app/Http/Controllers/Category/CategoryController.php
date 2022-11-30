<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index() {

        return view ('categories.index', [
            'categories' => Category::search (
                request ([
                    'search',
                    'newest'
                    ]))
                    ->visibleto(Auth::user())
                    ->get()
        ]);
    }

    public function create() {

        return view ('categories.create');
    }

    public function store(Request $request) {

        $attributes=$request->validate ([
            'name' => 'required|string|min:3|max:255',
        ]);

        $attributes += [

            'created_by' => Auth::id()
        ];

        $category = Category::where('name', $attributes['name'])
            ->withTrashed()
            ->first();

        if ($category) {

            if ($category->deleted_at != null) {

                $category->restore();
                $category->update($attributes);
            }
            
        } else {

            Category::create($attributes);
        }
        
        if ($request['create'] == 'create') {  

            return to_route('categories')
                ->with('success',  'Category Created Successfully.');
        }

        return back()->with('success', 'Category Created Successfully.');
    }

    public function edit(Category $category) {

        return view ('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category) {
       
        $attributes = $request->validate ([
            'name' => ['required','string','min:3','max:255'],
            'category' => ['required',
                Rule::in(Category::visibleTo(Auth::user())
                    ->get()
                    ->pluck('slug')
                    ->toArray()
                )
            ]
        ]);
        
        $category->update($attributes);

        return to_route('categories')
            ->with('success', 'Category Updated Successfully.');
    }

    public function delete(Category $category) {

        $category->delete();
        
        return to_route('categories')
            ->with('success', 'Category Deleted Successfully.');
    }
}
