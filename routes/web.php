<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\siteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\PemilikController as AdminPemilikController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dokter\DokterController;
use App\Http\Controllers\Perawat\PerawatController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\ResepsionisController;
use App\Http\Controllers\Pemilik\PemilikController;


// Main page routes
Route::get('/', [SiteController::class, 'index'])->name('site.cek-koneksi');
Route::get('/home', [SiteController::class, 'index'])->name('home');

// Authentication Routes
Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes yang sudah dibuat sebelumnya (dipindahkan ke bawah Auth::routes())
Route::get('/struktur-organisasi', function () {return view('main.st');})->name('struktur-organisasi');
Route::get('/layanan-umum', function () {return view('main.lu');})->name('layanan-umum');
Route::get('/visi-misi', function () {return view('main.vm');})->name('visi-misi');

// ============= AKSES ADMINISTRATOR =============
Route::middleware(['isAdministrator'])->prefix ('admin')->name ('admin.')-> group(function () {
    // Route untuk admin dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/data-master', [DashboardController::class, 'dataMaster'])->name('data-master');

    // Route untuk jenis hewan - CRUD
    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    Route::post('/jenis-hewan', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('/jenis-hewan/{id}/edit', [JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
    Route::put('/jenis-hewan/{id}', [JenisHewanController::class, 'update'])->name('jenis-hewan.update');
    Route::delete('/jenis-hewan/{id}', [JenisHewanController::class, 'destroy'])->name('jenis-hewan.destroy');
    

    // Route untuk data pemilik (table semua pemilik - untuk admin/resepsionis)
    Route::get('/data-pemilik', [AdminPemilikController::class, 'dataPemilik'])->name('pemilik.index');
    Route::get('/pemilik/{iduser}/edit', [AdminPemilikController::class, 'edit'])->name('pemilik.edit');
    Route::delete('/pemilik/{idpemilik}', [AdminPemilikController::class, 'destroy'])->name('pemilik.destroy');

    // Routes untuk User Management (VIEW ONLY - CRUD DISABLED)
    // User Management Routes
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}/reset-password', [UserController::class, 'showResetPassword'])->name('user.reset-password');
    Route::put('/user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password.update');

    // Routes untuk Role Management (VIEW ONLY - CRUD DISABLED)
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');

    // Routes untuk Daftar Role Management (Admin bisa CRUD role)
    Route::get('/role/daftar', [RoleController::class, 'daftarRole'])->name('role.daftar');
    Route::post('/role/store', [RoleController::class, 'storeRole'])->name('role.store');
    Route::delete('/role/delete/{role}', [RoleController::class, 'destroyRole'])->name('role.destroy');

    // Routes untuk Assign Role ke User
    Route::post('/role/assign', [RoleController::class, 'assignRole'])->name('role.assign');
    
    // Routes untuk Update Status dan Hapus Role dari User
    Route::put('/role/{idrole_user}/status', [RoleController::class, 'updateRoleStatus'])->name('role.update-status');
    Route::delete('/role/remove/{idrole_user}', [RoleController::class, 'removeRole'])->name('role.remove');

    // Routes untuk Ras Hewan - CRUD
    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
    Route::post('/ras-hewan', [RasHewanController::class, 'store'])->name('ras-hewan.store');
    Route::get('/ras-hewan/{id}/edit', [RasHewanController::class, 'edit'])->name('ras-hewan.edit');
    Route::put('/ras-hewan/{id}', [RasHewanController::class, 'update'])->name('ras-hewan.update');
    Route::delete('/ras-hewan/{id}', [RasHewanController::class, 'destroy'])->name('ras-hewan.destroy');

    // Routes untuk Pet Management (Admin hanya bisa edit NAMA)
    Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
    Route::get('/pet/{pet}/edit', [PetController::class, 'edit'])->name('pet.edit');
    Route::put('/min/pet/{pet}', [PetController::class, 'update'])->name('pet.update');

    // Routes untuk Kategori Management (Admin bisa CRUD)
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Routes untuk Kategori Klinis Management (Admin bisa CRUD)
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
    Route::post('/kategori-klinis', [KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    Route::get('/kategori-klinis/{kategoriKlinis}/edit', [KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
    Route::put('/kategori-klinis/{kategoriKlinis}', [KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
    Route::delete('/kategori-klinis/{kategoriKlinis}', [KategoriKlinisController::class, 'destroy'])->name('kategori-klinis.destroy');

    // Routes untuk Kode Tindakan/Terapi Management (Admin bisa CRUD)
    Route::get('/kode-tindakan', [KodeTindakanTerapiController::class, 'index'])->name('kode-tindakan.index');
    Route::post('/kode-tindakan', [KodeTindakanTerapiController::class, 'store'])->name('kode-tindakan.store');
    Route::get('/kode-tindakan/{kodeTindakan}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('kode-tindakan.edit');
    Route::put('/kode-tindakan/{kodeTindakan}', [KodeTindakanTerapiController::class, 'update'])->name('kode-tindakan.update');
    Route::delete('/kode-tindakan/{kodeTindakan}', [KodeTindakanTerapiController::class, 'destroy'])->name('kode-tindakan.destroy');
});

// ============= AKSES DOKTER =============
Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard Dokter
    Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dashboard');

    // Rekam Medis (Read Only)
    Route::get('/rekam-medis', [DokterController::class, 'rekamMedis'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [DokterController::class, 'detailRekamMedis'])->name('detail-rekam-medis');
});

// ============= AKSES PERAWAT =============
Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
    // Dashboard Perawat
    Route::get('/dashboard', [PerawatController::class, 'dashboard'])->name('dashboard');

    // Rekam Medis - CRUD
    Route::get('/rekam-medis', [PerawatController::class, 'rekamMedis'])->name('rekam-medis');
    Route::get('/rekam-medis/tambah/{idreservasi}', [PerawatController::class, 'tambahRekamMedis'])->name('tambah-rekam-medis');
    Route::post('/rekam-medis', [PerawatController::class, 'storeRekamMedis'])->name('rekam-medis.store');
    Route::get('/rekam-medis/{id}', [PerawatController::class, 'detailRekamMedis'])->name('detail-rekam-medis');
    Route::get('/rekam-medis/{id}/edit', [PerawatController::class, 'editRekamMedis'])->name('edit-rekam-medis');
    Route::put('/rekam-medis/{id}', [PerawatController::class, 'updateRekamMedis'])->name('rekam-medis.update');
    Route::delete('/rekam-medis/{id}', [PerawatController::class, 'deleteRekamMedis'])->name('rekam-medis.delete');

    // Detail Rekam Medis (Tindakan Terapi) - CRUD
    Route::post('/detail-rekam-medis', [PerawatController::class, 'storeDetailRekamMedis'])->name('detail-rekam-medis.store');
    Route::get('/detail-rekam-medis/{id}/edit', [PerawatController::class, 'editDetailRekamMedis'])->name('detail-rekam-medis.edit');
    Route::put('/detail-rekam-medis/{id}', [PerawatController::class, 'updateDetailRekamMedis'])->name('detail-rekam-medis.update');
    Route::delete('/detail-rekam-medis/{id}', [PerawatController::class, 'deleteDetailRekamMedis'])->name('detail-rekam-medis.delete');
});

// ============= AKSES RESEPSIONIS =============
Route::middleware(['isResepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    // Dashboard Resepsionis
    Route::get('/dashboard', [ResepsionisController::class, 'dashboard'])->name('dashboard');

    // Tambah Pemilik
    Route::get('/tambah-pemilik', [ResepsionisController::class, 'tambahPemilik'])->name('tambah-pemilik');
    Route::post('/pemilik', [ResepsionisController::class, 'storePemilik'])->name('pemilik.store');

    // Tambah Pet
    Route::get('/tambah-pet', [ResepsionisController::class, 'tambahPet'])->name('tambah-pet');
    Route::post('/pet', [ResepsionisController::class, 'storePet'])->name('pet.store');

    // Temu Dokter
    Route::get('/temu-dokter', [ResepsionisController::class, 'temuDokter'])->name('temu-dokter');
    Route::post('/temu-dokter', [ResepsionisController::class, 'storeTemuDokter'])->name('temu-dokter.store');
    Route::post('/temu-dokter', [ResepsionisController::class, 'storeTemuDokter'])->name('store-temu-dokter');
});

// ============= AKSES PEMILIK =============
Route::middleware(['isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    // Route untuk dashboard pemilik
    Route::get('/dashboard', [PemilikController::class, 'index'])->name('dashboard');

    // Route untuk daftar pet pemilik
    Route::get('/daftar-pet', [PemilikController::class, 'getPetList'])->name('daftar-pet');

    // Route untuk reservasi pemilik
    Route::get('/daftar-reservasi', [PemilikController::class, 'getReservasiList'])->name('reservasi');

    // Route untuk rekam medis pemilik
    Route::get('/daftar-rekam-medis', [PemilikController::class, 'getRekamMedisList'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [PemilikController::class, 'getRekamMedisDetail'])->name('rekam-medis.detail');

    // Route untuk profile pemilik
    Route::get('/profile', [PemilikController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [PemilikController::class, 'updateProfile'])->name('profile.update');
});