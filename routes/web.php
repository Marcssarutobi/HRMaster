<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementController;

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
    return view('welcome');
});


// Département
Route::post('/create',[DepartementController::class, 'CreateDep']);
Route::get('/allDerp',[DepartementController::class, 'AllDerp']);
Route::get('/allDerps',[DepartementController::class, 'AllDerps']);
Route::get('/getDep/{id}',[DepartementController::class,'show']);
Route::post('/updateDep', [DepartementController::class, 'updateDep']);
Route::post('/delDep', [DepartementController::class, 'delDep']);

//Poste
