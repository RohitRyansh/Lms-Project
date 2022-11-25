<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserStatusController extends Controller
{
    public function UserStatus(User $user,$status) {

        $attributes = [
            
            'status'=>$status
        ];

        $user->update($attributes);

        return to_route('users');
    }
}
