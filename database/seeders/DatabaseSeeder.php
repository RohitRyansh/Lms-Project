<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Category_Demo;
use App\Models\level;
use App\Models\Role;
use App\Models\Roll;
use App\Models\status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin'
        ]);
        Role::create([
            'name' => 'Sub_Admin',
            'slug' => 'sub-admin'
        ]);
        Role::create([
            'name' => 'Trainee',
            'slug' => 'trainee'
        ]);
        Role::create([
            'name' => 'Employee',
            'slug' => 'employee'
        ]);

        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'role_id' => 1,
            'slug' => 'admin-admin',
            'email' => 'admin@admin.com',
            'created_by' => '0',
            'phone_no' => 4854665445,
            'password' => Hash::make('123456789'),
            'image' => 'null'
        ]);
        
        User::create([
            'first_name' => 'aman',
            'last_name' => 'kumar',
            'role_id' => 2,
            'slug' => 'aman-kumar',
            'email' => 'aman@gmail.com',
            'created_by' => '1',
            'phone_no' => 4566448987,
            'password' => Hash::make('123456789'),
            'image' => 'null'
        ]);
        
        status::create([
            'name' => 'Published',
            'slug' => 'published'
        ]);

        status::create([
            'name' => 'Archived',
            'slug' => 'archived'
        ]);

        status::create([
            'name' => 'Draft',
            'slug' => 'draft'
        ]);

        for($i=1;$i<=10;$i++)
        {
            Category_Demo::create([
                'name' => 'Category'.$i,
            ]);
        }

        for($i=1;$i<=10;$i++)
        {
            level::create([
                'name' => 'Level'.$i,
            ]);
        }
    }
}
