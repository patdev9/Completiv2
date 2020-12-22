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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['auth:sanctum', 'verified'], function(){

    Route::post('/filiereSave', 'App\Http\Controllers\FiliereController@store');
    Route::get('/filiere', 'App\Http\Controllers\FiliereController@index')->name('admin.index');
    Route::delete('/deletefiliere/{id}', 'App\Http\Controllers\FiliereController@destroy');
    
    Route::get('/classes/{id}', 'App\Http\Controllers\ClasseController@index')->name('admin.classe');
    Route::post('/classesave', 'App\Http\Controllers\ClasseController@store');
    Route::delete('/classedelete/{id}', 'App\Http\Controllers\ClasseController@destroy');

    Route::get('/classeuser/{id}', 'App\Http\Controllers\UserController@classeuser')->name('admin.classeUser');
    Route::post('/classeUsave', 'App\Http\Controllers\UserController@store');

    Route::get('/classeEDT','App\Http\Controllers\CourController@classes')->name('admin.planing');
    Route::get('/EDT/{id}','App\Http\Controllers\CourController@index');
    Route::get('/units/{id}','App\Http\Controllers\CourController@units');
    Route::get('/formateur','App\Http\Controllers\CourController@user');
    Route::post('/edtsave','App\Http\Controllers\CourController@store');
    Route::get('/courDetails/{id}','App\Http\Controllers\CourController@details');

    Route::get('/appel/{id}','App\Http\Controllers\AbsenceController@index')->name('appel');
    Route::post('/absencesave','App\Http\Controllers\AbsenceController@store');
    Route::post('/justifier','App\Http\Controllers\AbsenceController@justifier');
    Route::get('/mesabsences/{id}','App\Http\Controllers\AbsenceController@absence')->name('mesabsences');

    Route::get('/abs','App\Http\Controllers\JustificatifController@index');
    Route::get('/clabs/{id}','App\Http\Controllers\JustificatifController@show');
    Route::get('/userabs/{id}','App\Http\Controllers\JustificatifController@userabs');

    Route::get('/ccp', 'App\Http\Controllers\ModuleEnseignementController@index')->name('admin.ccp');
    Route::post('/ccpsave', 'App\Http\Controllers\ModuleEnseignementController@store');
    Route::delete('/ccpdelete/{id}', 'App\Http\Controllers\ModuleEnseignementController@destroy');

    Route::get('/uniter/{id}','App\Http\Controllers\UniteEnseignementController@index')->name('admin.uniter');
    Route::post('/unitesave','App\Http\Controllers\UniteEnseignementController@store');
    Route::delete('/unitedelete/{id}','App\Http\Controllers\UniteEnseignementController@destroy');

    Route::get('/user', 'App\Http\Controllers\UserController@index')->name('admin.user');
    Route::get('/u', 'App\Http\Controllers\UserController@test');

    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard')->middleware('auth');
});
