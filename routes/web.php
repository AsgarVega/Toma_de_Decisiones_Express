<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TablaController;


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
//apartado de Miriam
Route::get('/', function () {
    return view('welcome');
});

Route::get('/cuadricula', function(){
    return redirect('/');
});
Route::post('/cuadricula',[TablaController::class, 'sizer']);

Route::get('/calcular', function(){
    return redirect('/');
});
Route::post('/calcular',[TablaController::class, 'procesar']);
//apartado de Gazga

Route::get('/test', function() {
    return view('gazga.home');
});