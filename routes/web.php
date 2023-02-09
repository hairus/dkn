<?php

use App\Http\Controllers\dataPokok;
use App\Http\Controllers\dataPokokController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\sekolahController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\SmpController;
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
    return view('welcome');
});

// Auth::routes();
Auth::routes(['register' => false]);
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('allSekolah', [sekolahController::class, 'index']);
    Route::get('allSekolah/create', [sekolahController::class, 'create']);
    Route::get('allSekolah/read', [sekolahController::class, 'read']);
    Route::post('allSekolah/store', [sekolahController::class, 'store']);
    Route::delete('allSekolah/destroy/{id}', [sekolahController::class, 'destroy']);
    Route::get('allSekolah/edit/{id}', [sekolahController::class, 'edit']);
    Route::patch('allSekolah/update', [sekolahController::class, 'update']);
    Route::resource('siswas', siswaController::class);
    Route::get('siswa/import', [siswaController::class, 'import']);
    Route::post('siswa/saveImport', [siswaController::class, 'saveImport']);
    Route::resource('smp', SmpController::class);
    Route::resource('dp', dataPokokController::class);
});
Route::get('/dp/getData', [dataPokokController::class, 'getData']);
