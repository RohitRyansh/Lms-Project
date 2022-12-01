<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserStatusController extends Controller
{
    public function UserStatus(User $user) {

        if($user->status == true) {

            $attributes = [
                'status' => false
            ];

        } else {

            $attributes = [
                'status' => true
            ];
        }
        
        $user->update($attributes);
        
        return to_route('users');
    }
}
