<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\ApiAdminController;
use App\Http\Controllers\dataPokok;
use App\Http\Controllers\dataPokokController;
use App\Http\Controllers\DeadlineController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\opApiController;
use App\Http\Controllers\opSiswaController;
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
    return redirect()->route('login');
});

Auth::routes();
// Auth::routes(['register' => false]);
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index2'])->name('home');
// role admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('allSekolah', [sekolahController::class, 'index']);
    Route::get('allSekolah/create', [sekolahController::class, 'create']);
    Route::get('allSekolah/read', [sekolahController::class, 'read'])->name('admin.read');
    Route::get('getDataSekolah', [sekolahController::class, 'getDataSekolah'])->name('getDataSekolah');
    Route::post('allSekolah/store', [sekolahController::class, 'store']);
    Route::delete('allSekolah/destroy/{id}', [sekolahController::class, 'destroy']);
    Route::get('allSekolah/edit/{id}', [sekolahController::class, 'edit']);
    Route::patch('allSekolah/update', [sekolahController::class, 'update']);
    Route::resource('siswas', siswaController::class);
    Route::get('siswa/import', [siswaController::class, 'import']);
    Route::post('siswa/saveImport', [siswaController::class, 'saveImport']);
    Route::resource('smp', SmpController::class);
    Route::get('/json', [SmpController::class, 'getDataSmp'])->name('getDataSmp');
    Route::resource('dp', dataPokokController::class);
    Route::get('/json/getData', [dataPokokController::class, 'getData'])->name('dp.getData');
    Route::get('/showSma', [ApiAdminController::class, 'showSma']);
    Route::get('/unlockds/{id}', [ApiAdminController::class, 'unlockds']);
    Route::get('/unlockns/{id}', [ApiAdminController::class, 'unlockns']);


    //management user
    Route::get("/genUsers",[adminController::class, 'genUsers']);
    Route::get("/showUser",[adminController::class, 'getuser']);


    //management unlock
    Route::get('/unlock', [adminController::class, 'unlock']);

    //management monitoring
    Route::get('monitoring', [adminController::class, 'monitoring']);
    Route::get('monitoring/show', [adminController::class, 'showMon']);
    Route::get('monitoring/detail/{id}', [adminController::class, 'showDet']);


    //management deadline
    Route::get('deadline', [DeadlineController::class, 'index']);
    Route::get('addDead', [DeadlineController::class, 'addDead']);
    Route::post('saveDead', [DeadlineController::class, 'saveDead']);
    Route::get('delDead/{id}', [DeadlineController::class, 'delDead']);
});

//role operator
Route::group(['prefix' => 'op', 'middleware' => ['auth', 'operator']], function(){
    Route::get('siswas', [opSiswaController::class, 'siswas']);
    Route::get('export', [opSiswaController::class, 'export']);
    Route::get('export2', [opSiswaController::class, 'export2']);
    Route::get('export/smp', [opSiswaController::class, 'exportsmp']);
    Route::get('getSiswa', [opApiController::class, 'getSiswa']);
    Route::get('siswa/import', [opSiswaController::class, 'import']);
    Route::post('siswa/saveImport', [opSiswaController::class, 'saveImport']);
    Route::get('siswaNilai', [opSiswaController::class, 'siswaNilai']);
    Route::get('changePass', [opSiswaController::class, 'changePass']);
    Route::post('updatePassword', [opSiswaController::class, 'updatePassword']);
    Route::get('siswa/edit/{id}', [opSiswaController::class, 'getsiswa']);
    Route::get('getNilai', [opApiController::class, 'getNilai']);
    Route::post('siswa/storenisn', [opSiswaController::class, 'storenisn']);
    Route::post('siswa/add', [opSiswaController::class, 'add']);
    Route::delete('siswa/delete/{id}', [opSiswaController::class, 'destroy']);
    Route::get('siswa/delSis', [opSiswaController::class, 'delSis']);
    Route::get('finalisasi', [opSiswaController::class, 'finalisasi2']);
    Route::post('final-siswa', [opSiswaController::class, 'final_data_siswa']);
    Route::post('final-nilai', [opSiswaController::class, 'final_data_nilai']);
    Route::post('agree', [opSiswaController::class, 'agree']);
    //Route::get('fds', [opSiswaController::class, 'fds']);
    //Route::get('fns', [opSiswaController::class, 'fns']);
});

Route::get('ceks', [opSiswaController::class, 'ceks']);
