<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('pages.index');
// });


Route::group(['middleware' => 'auth'], function () {



    Route::get('/admin/edit/{id}', [AdminController::class, 'adminEdit'])->name('adminEdit');
    Route::get('/admin/delete/{id}', [AdminController::class, 'adminDelete'])->name('adminDelete');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::get('admin//datable', [AdminController::class, 'datable'])->name('datable');


    Route::get('/formdata', [AdminController::class, 'getFormData'])->name('formdata.index');
    Route::get('/admin/state', [AdminController::class, 'adminState'])->name('adminState');
    Route::post('/admin/addState', [AdminController::class, 'addState'])->name('addState');
    Route::post('/admin/addDistrict', [AdminController::class, 'addDistrict'])->name('addDistrict');

    Route::get('/admin/district', [AdminController::class, 'adminDistrict'])->name('adminDistrict');

    Route::get('/admin/index', [AdminController::class, 'adminIndex'])->name('adminIndex');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Admin-only routes go here
});

Route::get('/', [UserController::class, 'insert'])->name('insertUser');
Route::post('/create', [UserController::class, 'create'])->name('create');



Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loggedIn');
Route::get('/get-districts/{stateId}', [UserController::class, 'getDistricts'])->name('get-districts');
