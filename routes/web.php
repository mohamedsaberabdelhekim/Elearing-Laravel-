<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('start');
});

Route::resource('/courses', CourseController::class);

Route::resource('/user', UserController::class);
Route::get("/user/courses/{user}",[UserController::class,"getCourses"])->name("user.courses");
Route::get("/enrollments/{user}",[UserController::class,"getEnrollments"])->name("user.enrollments");
Route::get("/enrolling/{courseID}",[UserController::class,"enrolling"]);
Route::get("/unenrolling/{courseID}",[UserController::class,"unenrolling"]);
Route::get("/available-courses/{user}",[UserController::class,"getAvailableCourses"])->name("user.availableCourses");
// Route::post("/enrolling",[UserController::class,"enrolling"]);

Route::resource('/reviews', ReviewController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function(){
    return view('about');
});

Route::get('/contact', function(){
    return view('contact');
});
