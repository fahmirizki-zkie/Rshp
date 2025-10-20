<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\siteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\DashboardController;

// route::get(`/cek_koneksi`, [SiteController::class, 'cek koneksi'])->name('site.cek-koneksi');

Route::get('/', function () {
    return view('main.index');
})->name('home');

Route::get('/struktur-organisasi', function () {
    return view('main.st');
})->name('struktur-organisasi');

Route::get('/layanan-umum', function () {
    return view('main.lu');
})->name('layanan-umum');

Route::get('/visi-misi', function () {
    return view('main.vm');
})->name('visi-misi');

// Route untuk jenis hewan (view only - CRUD disabled)
Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');

// Route untuk pemilik dashboard (individual)
Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');

// Route untuk data pemilik (table semua pemilik - untuk admin/resepsionis)
Route::get('/data-pemilik', [PemilikController::class, 'dataPemilik'])->name('admin.pemilik.index');
Route::get('/admin/pemilik/{iduser}/edit', [PemilikController::class, 'edit'])->name('admin.pemilik.edit');
Route::delete('/admin/pemilik/{idpemilik}', [PemilikController::class, 'destroy'])->name('admin.pemilik.destroy');

// Placeholder routes untuk resepsionis (bisa diimplementasikan nanti)
Route::get('/resepsionis/tambah-pemilik', function() {
    return redirect()->back()->with('info', 'Fitur tambah pemilik belum diimplementasikan');
})->name('resepsionis.tambah-pemilik');

Route::get('/resepsionis/dashboard', function() {
    return redirect('/')->with('info', 'Dashboard resepsionis belum diimplementasikan');
})->name('resepsionis.dashboard');

// Route untuk admin dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/data-master', [DashboardController::class, 'dataMaster'])->name('admin.data-master');

// Placeholder routes untuk menu data master (belum ada controller)
Route::get('/admin/user', function() {
    return redirect()->back()->with('info', 'Halaman Data User belum diimplementasikan');
})->name('admin.user.index');

Route::get('/admin/role', function() {
    return redirect()->back()->with('info', 'Halaman Manajemen Role belum diimplementasikan');
})->name('admin.role.index');

Route::get('/admin/ras-hewan', function() {
    return redirect()->back()->with('info', 'Halaman Ras Hewan belum diimplementasikan');
})->name('admin.ras-hewan.index');

Route::get('/admin/pet', function() {
    return redirect()->back()->with('info', 'Halaman Data Pet belum diimplementasikan');
})->name('admin.pet.index');

Route::get('/admin/kategori', function() {
    return redirect()->back()->with('info', 'Halaman Data Kategori belum diimplementasikan');
})->name('admin.kategori.index');

Route::get('/admin/kategori-klinis', function() {
    return redirect()->back()->with('info', 'Halaman Kategori Klinis belum diimplementasikan');
})->name('admin.kategori-klinis.index');

Route::get('/admin/kode-tindakan', function() {
    return redirect()->back()->with('info', 'Halaman Kode Tindakan belum diimplementasikan');
})->name('admin.kode-tindakan.index');

// Placeholder route untuk logout (bisa diimplementasikan nanti dengan Laravel auth)
Route::post('/logout', function() {
    // auth()->logout();
    return redirect('/')->with('success', 'Anda berhasil logout');
})->name('logout');