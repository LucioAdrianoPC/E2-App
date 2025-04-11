<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* Comunicados*/
Route::get('comunicado', 'App\Http\Controllers\api\RotasController@comunicado')->name('comunicado');
Route::get('cadcom/{id}', 'App\Http\Controllers\api\RotasController@cadcom')->name('cadcom');
/*Engenheiros*/
Route::get('engenheiro', 'App\Http\Controllers\api\RotasController@engenheiro')->name('engenheiro');
Route::get('cadengenheiro/{id}', 'App\Http\Controllers\api\RotasController@cadengenheiro')->name('cadengenheiro');
/*Fornecedores*/
Route::get('fornecedor', 'App\Http\Controllers\api\RotasController@fornecedor')->name('fornecedor');
Route::get('cadfor/{id}', 'App\Http\Controllers\api\RotasController@cadfor')->name('cadfor');
/*Empresas*/
Route::get('empresa', 'App\Http\Controllers\api\RotasController@empresa')->name('empresa');
Route::get('cadempresa/{id}', 'App\Http\Controllers\api\RotasController@cadempresa')->name('cadempresa');

Route::get('logout', 'App\Http\Controllers\api\LogoutController@perform');

//Print comunicado
Route::get('printcomunicado/{id}', 'App\Http\Controllers\api\RotasController@printcomunicado')->name('pc');

//Certificado
Route::get('certificado', 'App\Http\Controllers\api\RotasController@certificado')->name('certificado');
Route::get('cadcertificado/{id}', 'App\Http\Controllers\api\RotasController@cadcertificado')->name('cadcertificado');
Route::get('printcertificado/{id}', 'App\Http\Controllers\api\RotasController@printcertificado')->name('pce');
//Usuários
Route::get('usuarios', 'App\Http\Controllers\api\RotasController@usuarios')->name('usuarios');
Route::get('cadusuario/{id}', 'App\Http\Controllers\api\RotasController@CadUsuarios')->name('cadusuarios');

//Consolidado
Route::get('consolidado', 'App\Http\Controllers\api\RotasController@consolidado')->name('consolidado');
Route::get('cadconsolidado/{id}', 'App\Http\Controllers\api\RotasController@cadconsolidado')->name('cadcon');
Route::get('printconsolidado/{id}', 'App\Http\Controllers\api\RotasController@printconsolidado')->name('pco');
Route::get('editconsolidado/{id}', 'App\Http\Controllers\api\RotasController@editconsolidado')->name('eco');