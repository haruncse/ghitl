<?php

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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('home.home');
});

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
use App\Http\Controllers\EmployeeController;
Route::get('/employee', [EmployeeController::class,'index']);
Route::get('/employee/create', [EmployeeController::class,'create'])->name('create-employee');
Route::get('/employee/all', [EmployeeController::class,'employeeList'])->name('get-all-employee');
Route::post('/store-employee', [EmployeeController::class,'store'])->name('store-employee');
Route::get('/delete-employee/{id}', [EmployeeController::class,'destroy'])->name('delete-employee');
Route::post('/modify-employee', [EmployeeController::class,'update'])->name('modify-employee');