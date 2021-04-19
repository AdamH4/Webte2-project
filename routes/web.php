<?php

use App\Http\Controllers\TeacherAdminController;
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



//----------------------------------------- Admin Teacher Routes -----------------------------------------------------------------
Route::get('/teacher/dashboard', [TeacherAdminController::class, 'index'])->name('teacher.dashboard')->middleware('auth');


//----------------------------------------- Auth Routes -----------------------------------------------------------------
require __DIR__ . '/auth.php';
