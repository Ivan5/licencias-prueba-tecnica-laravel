<?php

use App\Http\Controllers\LicenciasController;
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

Route::get('/', 'LicenciasController@index')->name('index');
Route::get('/create','LicenciasController@create')->name('create');
Route::post('/','LicenciasController@store')->name('store');
Route::post('/activar/{id}','LicenciasController@activar')->name('activar');
Route::post('/renovar/{id}', 'LicenciasController@renovar')->name('renovar');
Route::post('/desactivar/{id}','LicenciasController@desactivar')->name('desactivar');