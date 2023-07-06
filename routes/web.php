<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\DataMapelController;
use App\Http\Controllers\DataPembelajaranController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\DataTapelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RekapAbsensiController;
use App\Models\User;
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

Route::get('/', function (User $role) {
  if (Auth::check()) {
      $role = Auth::user()->role;
      return redirect($role . '/dashboard');
  } else {
      return redirect('/login');
  }
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'cekLogin'])->name('login')->middleware('guest');

Route::group(['middleware' => ['auth']], function(){
  Route::post('/logout', LogoutController::class)->name('logout');

  Route::get('/{role}/dashboard', DashboardController::class)->name('dashboard.index');

  Route::resource('/{role}/datasiswa', DataSiswaController::class);
  Route::resource('/{role}/dataguru', DataGuruController::class);
  Route::resource('/{role}/dataadmin', DataAdminController::class);
  Route::resource('/{role}/datakelas', DataKelasController::class);
  Route::resource('/admin/datasekolah', DataSekolahController::class);
  Route::put('/admin/datasekolah/logoupdate/{id}', [DataSekolahController::class,'updateLogo'])->name('logosekolah.update');
  Route::resource('/admin/datatapel', DataTapelController::class);
  Route::resource('/admin/datamapel', DataMapelController::class);
  Route::resource('/{role}/datapembelajaran', DataPembelajaranController::class);
  Route::resource('/{role}/absensi', AbsensiController::class);
  Route::get('/{role}/absensi/kelolaabsensi/{id}', [AbsensiController::class, 'editAbsensi'])->name('kelolaabsensi.edit');
  Route::put('/{role}/absensi/kelolaabsensi/{id}', [AbsensiController::class, 'updateAbsensi'])->name('kelolaabsensi.update');
  Route::resource('/{role}/rekapabsensi', RekapAbsensiController::class);
  Route::get('/{role}/rekapabsensi/print/{id}', [RekapAbsensiController::class, 'printRekapitulasi'])->name('rekapabsensi.print');

  Route::get('/{role}/profil', [ProfilController::class, 'index'])->name('profil.index');
  Route::put('/updateprofil/{id}', [ProfilController::class, 'update'])->name('profil.update');
  Route::put('/updatefoto/{id}', [ProfilController::class, 'updatePhoto'])->name('foto.update');
  Route::put('/updateakun/{id}', [ProfilController::class, 'updateAkun'])->name('akunsaya.update');

});
