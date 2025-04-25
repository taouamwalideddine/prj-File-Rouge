<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Events\TestEvent;

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

// teacher routes
Route::middleware(['auth', 'teacher'])->prefix('teacher')->group(function () {

    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');

    Route::get('/classroom', [TeacherController::class, 'manageClassroom'])->name('teacher.classroom');
    Route::get('/classroom/requests', [TeacherController::class, 'joinRequests'])->name('teacher.requests');
    Route::post('/classroom/accept/{student}', [TeacherController::class, 'acceptRequest'])->name('teacher.accept');
    Route::post('/classroom/reject/{student}', [TeacherController::class, 'rejectRequest'])->name('teacher.reject');
// quizes management
Route::prefix('quizzes')->group(function () {
    Route::get('/', [TeacherController::class, 'quizzes'])->name('teacher.quizzes');
    Route::get('/create', [QuizController::class, 'create'])->name('teacher.quizzes.create');
    Route::post('/', [QuizController::class, 'store'])->name('teacher.quizzes.store');
    Route::get('/{quiz}', [QuizController::class, 'show'])->name('teacher.quizzes.show');
    Route::delete('/{quiz}', [QuizController::class, 'destroy'])->name('teacher.quizzes.delete');
    Route::get('/', [QuizController::class, 'index'])->name('teacher.quizzes');

// question managing
    Route::post('/{quiz}/questions', [QuizController::class, 'storeQuestion'])->name('teacher.quizzes.questions.store');
    Route::put('/questions/{question}', [QuizController::class, 'updateQuestion'])->name('teacher.quizzes.questions.update');
    Route::delete('/questions/{question}', [QuizController::class, 'deleteQuestion'])->name('teacher.quizzes.questions.delete');
    Route::post('/{quiz}/reorder', [QuizController::class, 'reorderQuestions'])->name('teacher.quizzes.reorder');
});
});

// student routes
Route::middleware(['auth', 'student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
//classroom interactions
    Route::get('/classrooms', [StudentController::class, 'classrooms'])->name('student.classrooms');
    Route::get('/classrooms/{classroom}', [StudentController::class, 'showClassroom'])->name('student.classrooms.show');
    Route::post('/classrooms/{classroom}/join', [StudentController::class, 'joinClassroom'])->name('student.classrooms.join');
// quizzes and results
    Route::get('/quizzes', [StudentController::class, 'quizzes'])->name('student.quizzes');
    Route::get('/quizzes/{quiz}', [StudentController::class, 'startQuiz'])->name('student.quizzes.take');
    Route::post('/quizzes/{quiz}', [StudentController::class, 'submitQuiz'])->name('student.quizzes.submit');
    Route::get('/results/{result}', [StudentController::class, 'quizResults'])->name('student.quiz.results');
});

Route::get('/test-broadcast', function () {
    broadcast(new TestEvent());
    return 'Broadcast sent';
});



// Fallback Route
Route::fallback(function () {
    return redirect('/login');
});
