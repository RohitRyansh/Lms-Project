<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryStatusController as CategoryCategoryStatusController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\CourseStatusController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\users\UserController;
use App\Http\Controllers\Users\UserStatusController as UsersUserStatusController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (Auth::check()) {
        if (Auth::user()->is_employee) {
            
            return to_route ('employee.index');
        }
         
        return redirect ('/dashboard');
    }

    return to_route ('login');
});

Route::middleware('guest')->group(function () {

    Route::get ('/login', [LoginController::class, 'index'])->name('login');

    Route::post ('/login', [LoginController::class, 'userAuthentication'])->name('Auth.userAuthentication');

    Route::get ('/reset/password', [ResetPasswordController::class, 'index'])->name('resetPassword');

    Route::post ('/reset/password/{user}', [ResetPasswordController::class, 'store'])->name('resetPassword.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard',function ()
    {
        return view ('dashboard.overview');
    });

Route::controller(UserController::class)->group(function () {

    Route::get ('/users','index')->name ('users');

    Route::get ('/users/create', 'create')->name ('users.create');
    
    Route::post ('/users/store', 'store')->name ('users.store');
    
    Route::get ('/users/{user}/edit', 'edit')->name ('users.edit');
    
    Route::post ('/users/{user}/update', 'update')->name ('users.update');
    
    Route::delete ('/users/{user}/delete', 'delete')->name ('users.delete');

});

Route::controller(CategoryController::class)->group(function () {

    Route::get ('/category', 'index')->name ('categories');
    
    Route::get ('/category/create', 'create')->name ('categories.create');
    
    Route::post ('/category/store', 'store')->name ('categories.store');
    
    Route::get ('/category/{category}/edit', 'edit')->name ('categories.edit');
    
    Route::post ('/category/{category}/update', 'update')->name ('categories.update');
    
    Route::delete ('/category/{category}/delete', 'delete')->name ('categories.delete');

});

Route::controller(CourseController::class)->group(function () {

    Route::get ('/courses','index')->name ('courses');
    
    Route::get ('/courses/create', 'create')->name ('courses.create');
    
    Route::post ('/courses/store', 'store')->name ('courses.store');
    
    Route::get ('/courses/{course}/edit', 'edit')->name ('courses.edit');
    
    Route::post ('/courses/{course}/update', 'update')->name ('courses.update');
    
    Route::get ('/courses/{course:slug}/view', 'view')->name ('courses.view');

}); 

Route::controller(UnitController::class)->group(function() {

    Route::get('/courses/{course:slug}/units/create', 'create')->name('units');

    Route::post('/courses/{course}/units/store', 'store')->name('units.store');

    Route::get('/courses/{course:slug}/unit/{unit}/edit', 'edit')->name('units.edit');

    Route::put('/courses/{course:slug}/unit/{unit}/update', 'update')->name('units.update');

    Route::delete('/courses/{course:slug}/unit/{unit}/delete', 'delete')->name('units.delete');

});

Route::controller(CourseEnrollmentController::class)->group(function() {

    Route::get ('/courseEnrollment/{course:slug}/Enroll','index')->name ('enroll.index');

    Route::post ('/courseEnrollment/store/{course:slug}', 'store')->name ('enroll.store');

    Route::delete ('/courseEnrollment/{course:slug}/Unenroll/{enrolledUser}', 'delete')->name ('enroll.delete');

});

Route::controller(EnrollmentController::class)->group(function() {

    Route::get ('/userEnrollment/{user:slug}/Enroll','index')->name ('userenroll.index');

    Route::post ('/userEnrollment/store/{user:slug}', 'store')->name ('userenroll.store');

    Route::delete ('/userEnrollment/{user:slug}/Unenroll/{enrolledCourse}', 'delete')->name ('userenroll.delete');

});

Route::controller(EmployeeController::class)->group(function() {

    Route::get ('/employee','index')->name ('employee.index');

});

Route::get ('/logout', [LoginController::class, 'logout'])->name('Auth.logout');

Route::post ('/users/{user}/{status}/active', [UsersUserStatusController::class,'UserStatus'])->name('users.status');

Route::post ('/category/{category}/{status}/active', [CategoryCategoryStatusController::class,'CategoryStatus'])->name('categories.status');

Route::get('/courses/{course}/status', [CourseStatusController::class, 'CourseStatus'])->name('courses.status');

Route::get ('/set-password/{user:slug}', [SetPasswordController::class,'index'])->name('setpassword.index');

Route::post ('/set-password/{user:slug}', [SetPasswordController::class,'store'])->name('setpassword');

});



