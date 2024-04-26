<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\EmployerController;

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
Route::get('/getDep/{id}',[DepartementController::class,'show']);
Route::post('/updateDep', [DepartementController::class, 'updateDep']);
Route::post('/delDep', [DepartementController::class, 'delDep']);

//Poste
Route::get('/depart',[DepartementController::class, 'Depart']);
Route::post('/createposte',[PosteController::class, 'CreatePost']);
Route::get('/allPoste',[PosteController::class, 'AllPoste']);
Route::get('/getPoste/{id}', [PosteController::class, 'GetPoste']);
Route::post('/updatePoste',[PosteController::class, 'UpdatePoste']);
Route::post('/delposte',[PosteController::class, 'DeletePoste']);
Route::get('/poste',[PosteController::class, 'Poste']);

//Etudiants
Route::post('/create',[EmployerController::class, 'CreateEmp']);
Route::post('/uploadPhoto',[EmployerController::class, 'UploadPhoto']);
Route::get('/allEmp', [EmployerController::class, 'AllEmp']);
Route::get('/getEmp/{id}',[EmployerController::class,'GetEmp']);
Route::post('/updateEmp',[EmployerController::class, 'UpdateEmp']);
Route::post('/delEmp',[EmployerController::class, 'DelEmp']);
Route::post('/delImage', [EmployerController::class,'deleteImage']);