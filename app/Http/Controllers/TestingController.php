<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index() {
  
        $collection = User::get();

        $filtered = $collection->filter(function ($user) {
            return $user->email->contains('admin');
        });
         
        dd($filtered->all());
         
    }
}
