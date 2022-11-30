<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ForgetPasswordController extends Controller
{
    public function index() {

        return view('users.forgetPassword');
    }

    public function mailConfirmation(Request $request) {

        $attributes = $request->validate ([
                'email'=>'required|email',
            ]);

        $user = User::where('email', $attributes['email'])->first();

        if($user) {
            
            Notification::send($user, new ForgetPasswordNotification());
    
            return back()->with('success', 'Password Mail has been sent Successfully');

        } else {

            return back()->with('error', 'No User Exist');
        }   
    } 
        
    public function store(Request $request) {

        $attributes = $request->validate ([
            'password'=>'required|min:8',
            'ConfirmPassword'=>'required|min:8|same:password'
        ]);
    }
    
}
