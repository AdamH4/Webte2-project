<?php

use App\Http\Controllers\TeacherAdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
    return view('landing.welcome');
})->name('home');

//----------------------------------------- Student Routes -----------------------------------------------------------------

Route::get('/questions', function () { // ROUTE JUST FOR TESTING PURPOSES
    return view('student.exam');
})->name('questions');

Route::post('/questions', [StudentController::class, 'index'])->name('questions.submit');
//----------------------------------------- Admin Teacher Routes -----------------------------------------------------------------
Route::get('/teacher/dashboard', [TeacherAdminController::class, 'index'])->name('teacher.dashboard')->middleware('auth');

Route::get('/teacher/exams', [ExamController::class, 'index'])->name('teacher.exams')->middleware('auth');
Route::get('/teacher/exams/create', [ExamController::class, 'create'])->name('teacher.exams.create')->middleware('auth');
Route::post('/teacher/exams', [ExamController::class, 'store'])->middleware('auth');
Route::get('/teacher/exams/{exam}', [ExamController::class, 'show'])->name('teacher.exams.show')->middleware('auth');
Route::get('/teacher/exams/{exam}/edit', [ExamController::class, 'edit'])->name('teacher.exams.edit')->middleware('auth');
Route::put('/teacher/exams/{exam}/edit', [ExamController::class, 'update'])->middleware('auth');
Route::delete('/teacher/exams/{exam}', [ExamController::class, 'destroy'])->middleware('auth');

Route::get('/teacher/exams/{exam}/questions/create', [QuestionController::class, 'create'])
	->name('teacher.questions.create')->middleware('auth');
Route::post('/teacher/exams/{exam}/questions/create', [QuestionController::class, 'store'])->middleware('auth');
Route::get('/teacher/exams/{exam}/questions/{qt}/edit', [QuestionController::class, 'edit'])
	->name('teacher.questions.edit')->middleware('auth');
Route::put('/teacher/exams/{exam}/questions/{qt}/edit', [QuestionController::class, 'update'])->middleware('auth');
Route::delete('/teacher/exams/{exam}/questions/{qt}/edit', [QuestionController::class, 'destroy'])->middleware('auth');

Route::get('/teacher/exams/{exam}/questions/{qt}/answers/create', [AnswerController::class, 'create'])
	->name('teacher.questions.answers.create')->middleware('auth');
Route::post('/teacher/exams/{exam}/questions/{qt}/answers/create', [AnswerController::class, 'store'])->middleware('auth');


//----------------------------------------- Auth Routes -----------------------------------------------------------------
require __DIR__ . '/auth.php';
