<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/dashboard', fn() => view('teacher.dashboard'))->name('teacher.dashboard');
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student/dashboard', fn() => view('student.dashboard'))->name('student.dashboard');
});
