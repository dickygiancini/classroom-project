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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

        Route::get('master-kelas', [\App\Http\Controllers\Master\MasterKelasController::class, 'index'])->name('masterkelas.index');
        Route::get('master-kelas-data', [\App\Http\Controllers\Master\MasterKelasController::class, 'index'])->name('masterkelas.getData');
        Route::post('master-kelas', [\App\Http\Controllers\Master\MasterKelasController::class, 'create'])->name('masterkelas.create');
    });

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('update_nik', [\App\Http\Controllers\ProfileController::class, 'update_nik'])->name('profile.update_nik');
});
