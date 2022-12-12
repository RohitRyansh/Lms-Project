<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ResetPasswordController extends Controller
{
    public function index(User $user) {

        return view('users.resetPassword', [
            'user'=>$user
        ]);
    }

    public function store(Request $request,User $user) {

        $attributes = $request->validate ([
                'password'=>'required|min:8',
                'ConfirmPassword'=>'required|min:8|same:password'
            ]);

        if ($user->update ([
            'password'=>Hash::make($attributes['password']),
            'email_status'=>1
        ])) {

        Notification::send($user, new SetPasswordNotification(Auth::user()));

        return to_route('users')
            ->with('status', 'Password Changed');            
        }
    } 
}
