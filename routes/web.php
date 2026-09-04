<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
// Route::get('/students', [StudentController::class, 'index']);
// Route::get('/students/create', [StudentController::class, 'create']);
// Route::post('/students', [StudentController::class, 'store']);
// Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
// Route::put('/students/{id}', [StudentController::class, 'update']);
// Route::delete('/students/{id}', [StudentController::class, 'destroy']);
// Route::get('/students/{id}', [StudentController::class, 'show']);
// Route::get('/dashboard', [StudentController::class, 'dashboard']);
// Route::get('/dashboard', [StudentController::class, 'dashboard'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/create', [StudentController::class, 'create']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::get('/dashboard', [StudentController::class, 'dashboard']);


    // Courses 
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/create', [CourseController::class, 'create']);
Route::post('/courses', [CourseController::class, 'store']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
Route::get('/courses/{id}/edit', [CourseController::class, 'edit']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
});

// Login Route:
use App\Http\Controllers\AuthController;


// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/register', [AuthController::class, 'showRegister']);
// Route::post('/register', [AuthController::class, 'register']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Courses Route:

// Route::get('/courses', [CourseController::class, 'index']);
// Route::get('/courses/create', [CourseController::class, 'create']);
// Route::post('/courses', [CourseController::class, 'store']);
// Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
// Route::get('/courses/{id}/edit', [CourseController::class, 'edit']);
// Route::put('/courses/{id}', [CourseController::class, 'update']);
// Route::get('/courses/{id}', [CourseController::class, 'show']);

// Teachers Route
use App\Http\Controllers\TeacherController;

Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/create', [TeacherController::class, 'create']);
Route::post('/teachers', [TeacherController::class, 'store']);
Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit']);
Route::put('/teachers/{id}', [TeacherController::class, 'update']);
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);
Route::get('/teachers/{id}', [TeacherController::class, 'show']);

// Classes Route
use App\Http\Controllers\ClassController;

Route::get('/classes', [ClassController::class, 'index']);
Route::get('/classes/create', [ClassController::class, 'create']);
Route::post('/classes', [ClassController::class, 'store']);
Route::get('/classes/{id}/edit', [ClassController::class, 'edit']);
Route::put('/classes/{id}', [ClassController::class, 'update']);
Route::delete('/classes/{id}', [ClassController::class, 'destroy']);

// Attendance Route
use App\Http\Controllers\AttendanceController;

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::get('/attendance/create', [AttendanceController::class, 'create']);
Route::get('/attendance/report', [AttendanceController::class, 'report']);
Route::post('/attendance', [AttendanceController::class, 'store']);
Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit']);
Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy']);


// Fees Route
use App\Http\Controllers\FeeController;

Route::get('/fees', [FeeController::class, 'index']);
Route::get('/fees/create', [FeeController::class, 'create']);
Route::get('/fees/history', [FeeController::class, 'history']);
Route::post('/fees', [FeeController::class, 'store']);
Route::get('/fees/{id}/edit', [FeeController::class, 'edit']);
Route::put('/fees/{id}', [FeeController::class, 'update']);