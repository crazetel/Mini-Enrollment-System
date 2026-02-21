<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () { return view('welcome'); });

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [CourseController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Courses & Enrollment
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/courses/{id}/unenroll', [CourseController::class, 'unenroll'])->name('courses.unenroll');

    Route::resource('courses', CourseController::class);
    Route::resource('students', StudentController::class);
    
    // Admin Controls
    Route::middleware('can:admin')->group(function () {
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/admin/users', [CourseController::class, 'manageUsers'])->name('admin.users');
        
        // Match this name exactly to what is in your resources/views/admin/users.blade.php
        Route::patch('/admin/users/{user}', [CourseController::class, 'updateRole'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [CourseController::class, 'deleteUser'])->name('admin.users.delete');
    });
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

        Route::post('/enroll', [CourseController::class, 'enroll'])->name('enroll.store');
        });

require __DIR__.'/auth.php';