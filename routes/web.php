<?php

use App\Http\Controllers\TeacherAdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReviewController;
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

Route::post('/exam/login', [StudentController::class, 'loginToExam'])->name('exam.login');
Route::post('/exam/left/{exam}', [StudentController::class, 'leftExam'])->name('exam.left');
Route::post('/exam/done/{exam}', [StudentController::class, 'doneExam'])->name('exam.done');
Route::get('/exam/{exam}', [StudentController::class, 'exam'])->name('exam.show')->middleware('in-exam');
Route::get('/exam/change/{status}', [StudentController::class, 'changeExamStatus'])->name('exam.status')->middleware('in-exam');

//----------------------------------------- Admin Teacher Routes -----------------------------------------------------------------
Route::get('/teacher/dashboard', [TeacherAdminController::class, 'index'])->name('teacher.dashboard')->middleware('auth');

Route::get('/teacher/exams', [ExamController::class, 'index'])->name('teacher.exams')->middleware('auth');
Route::get('/teacher/exams/create', [ExamController::class, 'create'])->name('teacher.exams.create')->middleware('auth');
Route::post('/teacher/exams', [ExamController::class, 'store'])->middleware('auth');
Route::get('/teacher/exams/{exam}', [ExamController::class, 'show'])->name('teacher.exams.show')->middleware('auth');
Route::get('/teacher/exams/{exam}/edit', [ExamController::class, 'edit'])->name('teacher.exams.edit')->middleware('auth');
Route::put('/teacher/exams/{exam}/edit', [ExamController::class, 'update'])->middleware('auth');
Route::delete('/teacher/exams/{exam}', [ExamController::class, 'destroy'])->middleware('auth');

Route::get('/teacher/exams-active', [ExamController::class, 'indexActive'])->name('teacher.exams_active')->middleware('auth');
Route::get('/teacher/exams-active/{exam}', [ExamController::class, 'showActive'])->name('teacher.exams_active.show')->middleware('auth');

Route::get('/teacher/exams-reviews', [ReviewController::class, 'index'])->name('teacher.exams_reviews')->middleware('auth');
Route::get('/teacher/exams-reviews/{exam}', [ReviewController::class, 'showExam'])->name('teacher.exams_reviews.show_exam')
	->middleware('auth');
Route::get('/teacher/exams-reviews/{exam}/export', [ReviewController::class, 'exportExamResultsCSV'])->name('teacher.exams_reviews.export_exam_results')
    ->middleware('auth');
Route::get('/teacher/exams-reviews/{exam}/{student}', [ReviewController::class, 'showStudent'])->name('teacher.exams_reviews.show_student')
	->middleware('auth');
Route::post('/teacher/exams-reviews/{exam}/{student}', [ReviewController::class, 'updatePoints'])
	->name('teacher.exams_reviews.update_points')->middleware('auth');
Route::get('/teacher/exams-reviews/{exam}/{student}/export', [ReviewController::class, 'exportPDF'])->name('teacher.exams_reviews.export_submitted_exam')
    ->middleware('auth');

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
