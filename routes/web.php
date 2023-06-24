<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/store', [DashboardController::class, 'store'])->name('course_student.store');
    Route::delete('/destroy/{student}', [DashboardController::class, 'destroy'])->name('course_student.destroy');
    // Route::get('/create', [DashboardController::class, 'create'])->name('course_student.create');
    // Route::get('/show/{course_student}', [DashboardController::class, 'show'])->name('course_student.show');
    // Route::get('/edit/{course_student}', [DashboardController::class, 'edit'])->name('course_student.edit');
    // Route::patch('/update/{course_student}', [DashboardController::class, 'update'])->name('course_student.update');
});

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
    Route::get('/list-courses/{student}', [StudentController::class, 'listCourses'])->name('student.list-courses');
});

Route::middleware('auth')->prefix('course')->group(function() {
    Route::get('/', [CourseController::class, 'index'])->name('course.index');
    Route::get('/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('/show/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('course.edit');
    Route::patch('/update/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
});

require __DIR__.'/auth.php';
