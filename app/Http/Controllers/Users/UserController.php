<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index() {
  
        return view ('users.index', [
            'users' => User::visibleto(Auth::user())
                ->search (
                    request ([
                        'search',
                        'role',
                        'newest'
                        ]))
                ->simplePaginate(4), 
            'roles' => Role::allrole()->get(),
        ]);
    }

    public function create() {

        return view ('users.create', [
            'roles' => Role::allrole()->get()
        ]);
    }

    public function store(Request $request) {

       $attributes = $request->validate ([   
            'first_name' =>  'required|string|min:3|max:255',
            'last_name' => 'required|string|min:1|max:255',
            'email' => 'required|email',
            'phone_no' => 'required|numeric|digits:10',
            'role_id' => 'required',[
                Rule::in(Role::allrole()
                ->get()
                ->pluck('id')
                ->toArray()
                )
            ],  
        ]);

        $attributes += [

            'created_by' => Auth::id()
        ];

        $user = User::where('first_name', $attributes['first_name'])
            ->withTrashed()
            ->first();

        if ($user) {
            
            if ($user->deleted_at != null) {

                $user->restore();
                $user->update($attributes);
            }
            
        } else {

            $user = User::create($attributes);
        }

        if ($user) { 

            Notification::send($user, new SetPasswordNotification(Auth::user()));

            if ($request['create'] == 'create') {  

                return to_route('users')
                    ->with('success',  'User Created Successfully.');
            }

            return back()->with('success', 'User Created Successfully.');   
        }
    }

    public function edit(User $user) {

        return view ('users.edit', [
            'user' => $user
        ]);    
    }

    public function update(Request $request, User $user) {

        $attributes = $request->validate ([   
            'first_name' =>  'required|string|min:3|max:255',
            'last_name' => 'required|string|min:1|max:255',
            'phone_no' => 'required|numeric|digits:10',
        ]);

        $user->update($attributes);

        return to_route('users')
            ->with('success', 'User Updated Successfully.');
    }

    public function delete(User $user) {

        $user->delete();
        
        return to_route('users')
            ->with('success', 'User Deleted Successfully.');
    }
}
