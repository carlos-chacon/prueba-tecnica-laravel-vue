<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware('auth')->apiResource('student', StudentController::class);

Route::middleware('auth')->prefix('student')->group(function() {
    Route::get('/', [StudentController::class, 'index'])->name('student.index');
    Route::get('/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/store', [StudentController::class, 'store'])->name('student.store');
    Route::get('/show/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
    Route::patch('/update/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/destroy/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::post('/course/{student}', [StudentController::class, 'addCourse'])->name('student.add-course');
    Route::delete('/course/{student}', [StudentController::class, 'deleteCourse'])->name('student.delete-course');
});

Route::middleware('auth')->prefix('course')->group(function() {
    Route::get('/', [CourseController::class, 'index'])->name('course.index');
    Route::get('/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('/show/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('course.edit');
    Route::patch('/update/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
    Route::post('/list', [CourseController::class, 'list'])->name('course.list');
});

Route::middleware('auth')->prefix('course_student')->group(function() {
    Route::get('/', [CourseStudentController::class, 'index'])->name('course_student.index');
    Route::get('/create', [CourseStudentController::class, 'create'])->name('course_student.create');
    Route::post('/store', [CourseStudentController::class, 'store'])->name('course_student.store');
    Route::get('/show/{course_student}', [CourseStudentController::class, 'show'])->name('course_student.show');
    Route::get('/edit/{course_student}', [CourseStudentController::class, 'edit'])->name('course_student.edit');
    Route::patch('/update/{course_student}', [CourseStudentController::class, 'update'])->name('course_student.update');
    Route::delete('/destroy/{course_student}', [CourseStudentController::class, 'destroy'])->name('course_student.destroy');
});

require __DIR__.'/auth.php';
