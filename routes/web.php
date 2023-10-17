<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\AssignmentsController;
use App\Http\Controllers\admin\ChallController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\SubmitAssignments;
use App\Http\Controllers\teacher\TeacherController;
use App\Http\Controllers\teacher\TeaUserController;
use App\Http\Controllers\teacher\TeaMessageController;
use App\Http\Controllers\teacher\TeaAssignmentsController;
use App\Http\Controllers\teacher\TeaChallengesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// student 
Route::get('/', [StudentController::class, 'login'])->name('login');
Route::post('/', [StudentController::class, 'postLogin'])->name('login.post');
Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
Route::prefix('student')->middleware('student')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/user', [StudentController::class, 'userindex'])->name('userindex');
    Route::get('/user/{user}', [StudentController::class, 'userDetail'])->name('show');
    Route::post('/message', [StudentController::class, 'messStore'])->name('messStore');
    Route::get('/message/{message}/edit', [StudentController::class, 'messEdit'])->name('messEdit');
    Route::delete('message/{message}', [StudentController::class, 'messDestroy'])->name('messDestroy');
    Route::get('/message', [StudentController::class, 'messindex'])->name('messindex');
    Route::get('/assignments', [StudentController::class, 'assignindex'])->name('assignindex');
    Route::get('/submit/{submit}', [StudentController::class, 'submitshow'])->name('submitshow');
    Route::post('/submit', [StudentController::class, 'submitstore'])->name('submitstore');
    Route::get('/challenges', [StudentController::class, 'challindex'])->name('challindex');
    Route::get('/challenges/{challenge}', [StudentController::class, 'challdetail'])->name('challdetail');
    Route::get('/challenges/{challenge}/edit', [StudentController::class, 'challedit'])->name('challedit');
});

// Teacher
Route::prefix('teacher')->middleware('teacher')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');
    Route::resource('/tuser', TeaUserController::class);
    Route::resource('/tmessage', TeaMessageController::class);
    Route::resource('/tassignments', TeaAssignmentsController::class);
    Route::resource('/tchallenges', TeaChallengesController::class);
});

// accout chung
Route::get('account', [AdminController::class, 'account'])->name('account');
Route::post('account', [AdminController::class, 'postAccount'])->name('postAccount');

// admin
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'postLogin'])->name('admin.login.post');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('admin.index');
    Route::resource('/user', UsersController::class);
    Route::resource('/message', MessageController::class);
    Route::resource('/assignments', AssignmentsController::class);
    Route::resource('/challenges', ChallController::class);
    Route::resource('/submit', SubmitAssignments::class);
});