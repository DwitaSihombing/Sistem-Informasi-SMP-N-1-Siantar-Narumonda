<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TataUsahaController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Auth::routes();

Route::get('/', [HomeController::class, 'welcome'])->name('index');
Route::get('/blog/detail/{blog_id}', [HomeController::class, 'blogDetail'])->name('blog.detail');

Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/ekstrakulikuler', [HomeController::class, 'ekstrakulikuler'])->name('ekstrakulikuler');
Route::get('/fasilitas', [HomeController::class, 'fasilitas'])->name('fasilitas');
Route::get('/prestasi', [HomeController::class, 'prestasi'])->name('prestasi');

/*
Role
0 => Calon Siswa
1 => Siswa
2 => Guru
3 => Tata Usaha
4 => Admin
*/
Route::group(['middleware' => ['auth', 'check.role:0,1,2,3,4']] , function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user', [UserController::class, 'getProfile'])->name('user');
    Route::post('/user/edit/photo', [UserController::class, 'postEditPhoto'])->name('user.edit.photo');
    Route::post('/user/edit/account', [UserController::class, 'postEditAccount'])->name('user.edit.account');
    Route::post('/user/edit/password', [UserController::class, 'postEditPassword'])->name('user.edit.password');
    Route::post('/user/edit/calon/siswa', [UserController::class, 'postEditCalonSiswa'])->name('user.edit.calon.siswa');
    Route::post('/user/edit/calon/berkas', [UserController::class, 'postEditBerkas'])->name('user.edit.calon.berkas');
});

Route::group(['middleware' => ['auth', 'check.role:0']] , function() {
    Route::get('/calon/informasi', [CalonSiswaController::class, 'informasi'])->name('calon.informasi');
});

Route::group(['middleware' => ['auth', 'check.role:1']] , function() {
    Route::get('/siswa/ekstrakulikuler', [SiswaController::class, 'ekstrakulikuler'])->name('siswa.ekstrakulikuler');
    Route::get('/siswa/ekstrakulikuler/join/{ekstrakulikuler_id}', [SiswaController::class, 'getJoinEkstrakulikuler'])->name('siswa.ekstrakulikuler.join');
    Route::get('/siswa/ekstrakulikuler/detail/{ekstrakulikuler_id}', [SiswaController::class, 'getDetailEkstrakulikuler'])->name('siswa.ekstrakulikuler.detail');
});

Route::group(['middleware' => ['auth', 'check.role:2']] , function() {
    Route::get('/guru/ekstrakulikuler', [GuruController::class, 'ekstrakulikuler'])->name('guru.ekstrakulikuler');
    Route::get('/guru/ekstrakulikuler/add', [GuruController::class, 'getAddEkstrakulikuler'])->name('guru.ekstrakulikuler.add');
    Route::post('/guru/ekstrakulikuler/add', [GuruController::class, 'postAddEkstrakulikuler'])->name('guru.ekstrakulikuler.add');
    Route::get('/guru/ekstrakulikuler/delete/{ekstrakulikuler_id}', [GuruController::class, 'getDeleteEkstrakulikuler'])->name('guru.ekstrakulikuler.delete');
    Route::get('/guru/ekstrakulikuler/edit/{ekstrakulikuler_id}', [GuruController::class, 'getEditEkstrakulikuler'])->name('guru.ekstrakulikuler.edit');
    Route::post('/guru/ekstrakulikuler/edit', [GuruController::class, 'postEditEkstrakulikuler'])->name('guru.ekstrakulikuler.edit.post');

    Route::get('/guru/ekstrakulikuler/anggota/{ekstrakulikuler_id}', [GuruController::class, 'getanggotaEkstrakulikuler'])->name('guru.ekstrakulikuler.anggota');
    Route::get('/guru/ekstrakulikuler/anggota/delete/{ekstrakulikuler_id}/{anggota_id}', [GuruController::class, 'getDeleteAnggotaEkstrakulikuler'])->name('guru.ekstrakulikuler.anggota.delete');
});

Route::group(['middleware' => ['auth', 'check.role:3']] , function() {
    Route::get('/tatausaha/murid', [TataUsahaController::class, 'murid'])->name('tatausaha.murid');
    Route::get('/tatausaha/murid/edit/{user_id}', [TataUsahaController::class, 'getEditMurid'])->name('tatausaha.murid.edit');
    Route::post('/tatausaha/murid/edit', [TataUsahaController::class, 'postEditMurid'])->name('tatausaha.murid.edit.post');

    Route::get('/tatausaha/pendaftaran', [TataUsahaController::class, 'pendaftaran'])->name('tatausaha.pendaftaran');
    Route::get('/tatausaha/pendaftaran/add', [TataUsahaController::class, 'getAddPendaftaran'])->name('tatausaha.pendaftaran.add');
    Route::post('/tatausaha/pendaftaran/add', [TataUsahaController::class, 'postAddPendaftaran'])->name('tatausaha.pendaftaran.add');
    Route::get('/tatausaha/pendaftaran/edit/{pendaftaran_id}', [TataUsahaController::class, 'getEditPendaftaran'])->name('tatausaha.pendaftaran.edit');
    Route::post('/tatausaha/pendaftaran/edit', [TataUsahaController::class, 'posteditPendaftaran'])->name('tatausaha.pendaftaran.edit.post');
    Route::get('/tatausaha/pendaftaran/delete/{pendaftaran_id}', [TataUsahaController::class, 'getDeletePendaftaran'])->name('tatausaha.pendaftaran.delete');


    Route::get('/tatausaha/siswa/calon/{pendaftaran_id}', [TataUsahaController::class, 'calonSiswa'])->name('tatausaha.siswa.calon');
    Route::get('/tatausaha/siswa/calon/{pendaftaran_id}/laporan', [TataUsahaController::class, 'buatLaporan'])->name('tatausaha.siswa.calon.laporan');
    Route::get('/tatausaha/siswa/calon/view/{user_id}/{pendaftaran_id}', [TataUsahaController::class, 'getViewCalonSiswa'])->name('tatausaha.siswa.calon.view');
    Route::get('/tatausaha/siswa/calon/edit/{user_id}/{pendaftaran_id}', [TataUsahaController::class, 'getEditCalonSiswa'])->name('tatausaha.siswa.calon.edit');
    Route::post('/tatausaha/siswa/calon/edit', [TataUsahaController::class, 'postEditCalonSiswa'])->name('tatausaha.siswa.calon.edit.post');
    Route::get('/tatausaha/siswa/calon/verification/{user_id}/{pendaftaran_id}/{action}', [TataUsahaController::class, 'getVerefiedCalonSiswa'])->name('tatausaha.siswa.calon.verification');

});

Route::group(['middleware'=>['auth', 'check.role:3,4']], function(){
    Route::get('/manage/blog', [ManageController::class, 'blog'])->name('manage.blog');
    Route::get('/manage/blog/add', [ManageController::class, 'getBlogAdd'])->name('manage.blog.add');
    Route::post('/manage/blog/add', [ManageController::class, 'postBlogAdd'])->name('manage.blog.add');
    Route::get('/manage/blog/edit/{blog_id}', [ManageController::class, 'getBlogEdit'])->name('manage.blog.edit');
    Route::post('/manage/blog/edit', [ManageController::class, 'postBlogEdit'])->name('manage.blog.edit.post');
    Route::get('/manage/blog/delete/{blog_id}', [ManageController::class, 'getBlogDelete'])->name('manage.blog.delete');
});

Route::group(['middleware' => ['auth', 'check.role:4']] , function() {
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/user/add', [AdminController::class, 'getUserAdd'])->name('admin.user.add');
    Route::post('/admin/user/add', [AdminController::class, 'postUserAdd'])->name('admin.user.add');
    Route::get('/admin/user/edit/{user_id}', [AdminController::class, 'getUserEdit'])->name('admin.user.edit');
    Route::post('/admin/user/edit', [AdminController::class, 'postUserEdit'])->name('admin.user.edit.post');
    Route::get('/admin/user/delete/{user_id}', [AdminController::class, 'getUserDelete'])->name('admin.user.delete');

    Route::get('/admin/fasilitas', [AdminController::class, 'fasilitas'])->name('admin.fasilitas');
    Route::get('/admin/fasilitas/add', [AdminController::class, 'getFasilitasAdd'])->name('admin.fasilitas.add');
    Route::post('/admin/fasilitas/add', [AdminController::class, 'postFasilitasAdd'])->name('admin.fasilitas.add');
    Route::get('/admin/fasilitas/edit/{fasilitas_id}', [AdminController::class, 'getFasilitasEdit'])->name('admin.fasilitas.edit');
    Route::post('/admin/fasilitas/edit', [AdminController::class, 'postFasilitasEdit'])->name('admin.fasilitas.edit.post');
    Route::get('/admin/fasilitas/delete/{fasilitas_id}', [AdminController::class, 'getFasilitasDelete'])->name('admin.fasilitas.delete');

    Route::get('/admin/prestasi', [AdminController::class, 'prestasi'])->name('admin.prestasi');
    Route::get('/admin/prestasi/add', [AdminController::class, 'getPrestasiAdd'])->name('admin.prestasi.add');
    Route::post('/admin/prestasi/add', [AdminController::class, 'postPrestasiAdd'])->name('admin.prestasi.add');
    Route::get('/admin/prestasi/edit/{prestasi_id}', [AdminController::class, 'getPrestasiEdit'])->name('admin.prestasi.edit');
    Route::post('/admin/prestasi/edit', [AdminController::class, 'postPrestasiEdit'])->name('admin.prestasi.edit.post');
    Route::get('/admin/prestasi/delete/{prestasi_id}', [AdminController::class, 'getPrestasiDelete'])->name('admin.prestasi.delete');
});

Route::get('/siswa/daftar', [UserController::class, 'getDaftar'])->name('siswa.daftar');
Route::post('/siswa/daftar', [UserController::class, 'postDaftar'])->name('siswa.daftar');
