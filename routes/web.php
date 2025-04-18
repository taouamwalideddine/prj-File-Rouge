<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::prefix('teacher')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/classroom', [TeacherController::class, 'manageClassroom'])->name('teacher.classroom');
    Route::get('/classroom/requests', [TeacherController::class, 'joinRequests'])->name('teacher.requests');
    Route::post('/classroom/accept/{student}', [TeacherController::class, 'acceptRequest'])->name('teacher.accept');
    Route::post('/classroom/reject/{student}', [TeacherController::class, 'rejectRequest'])->name('teacher.reject');

    Route::prefix('quizzes')->group(function () {
        Route::get('/', [TeacherController::class, 'quizzes'])->name('teacher.quizzes');
        Route::get('/create', [TeacherController::class, 'createQuiz'])->name('teacher.quizzes.create');
        Route::post('/', [TeacherController::class, 'storeQuiz'])->name('teacher.quizzes.store');
        Route::delete('/{quiz}', [TeacherController::class, 'deleteQuiz'])->name('teacher.quizzes.delete');
        Route::get('/{quiz}/results', [TeacherController::class, 'quizResults'])->name('teacher.quizzes.results');
    });
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});

// Fallback Route
Route::fallback(function () {
    return redirect('/login');
});
