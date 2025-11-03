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
Route::middleware(['isAdministrator'])->group(function () {
    // Route untuk admin dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/data-master', [DashboardController::class, 'dataMaster'])->name('admin.data-master');

    // Route untuk jenis hewan (view only - CRUD disabled)
    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    
    // Route untuk data pemilik (table semua pemilik - untuk admin/resepsionis)
    Route::get('/data-pemilik', [AdminPemilikController::class, 'dataPemilik'])->name('admin.pemilik.index');
    Route::get('/admin/pemilik/{iduser}/edit', [AdminPemilikController::class, 'edit'])->name('admin.pemilik.edit');
    Route::delete('/admin/pemilik/{idpemilik}', [AdminPemilikController::class, 'destroy'])->name('admin.pemilik.destroy');

    // Routes untuk User Management (VIEW ONLY - CRUD DISABLED)
    // User Management Routes
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/user/{id}/reset-password', [UserController::class, 'showResetPassword'])->name('admin.user.reset-password');
    Route::put('/admin/user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('admin.user.reset-password.update');

    // Routes untuk Role Management (VIEW ONLY - CRUD DISABLED)
    Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.role.index');

    // Routes untuk Daftar Role Management (Admin bisa CRUD role)
    Route::get('/admin/role/daftar', [RoleController::class, 'daftarRole'])->name('admin.role.daftar');
    Route::post('/admin/role/store', [RoleController::class, 'storeRole'])->name('admin.role.store');
    Route::delete('/admin/role/{role}', [RoleController::class, 'destroyRole'])->name('admin.role.destroy');

    // CRUD Routes - Disabled for now (hanya view yang aktif)
    // Route::post('/admin/role/assign', [RoleController::class, 'assignRole'])->name('admin.role.assign');
    // Route::put('/admin/role/{idrole_user}/status', [RoleController::class, 'updateRoleStatus'])->name('admin.role.update-status');
    // Route::delete('/admin/role/{idrole_user}', [RoleController::class, 'removeRole'])->name('admin.role.remove');
    // Route::get('/admin/role/create', [RoleController::class, 'createRole'])->name('admin.role.create');

    // Route untuk ras hewan (view only - CRUD disabled)
    Route::get('/admin/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');

    // Routes untuk Pet Management (Admin hanya bisa edit NAMA)
    Route::get('/admin/pet', [PetController::class, 'index'])->name('admin.pet.index');
    Route::get('/admin/pet/{pet}/edit', [PetController::class, 'edit'])->name('admin.pet.edit');
    Route::put('/admin/pet/{pet}', [PetController::class, 'update'])->name('admin.pet.update');

    // Routes untuk Kategori Management (Admin bisa CRUD)
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/admin/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/{kategori}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    // Routes untuk Kategori Klinis Management (Admin bisa CRUD)
    Route::get('/admin/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
    Route::post('/admin/kategori-klinis', [KategoriKlinisController::class, 'store'])->name('admin.kategori-klinis.store');
    Route::get('/admin/kategori-klinis/{kategoriKlinis}/edit', [KategoriKlinisController::class, 'edit'])->name('admin.kategori-klinis.edit');
    Route::put('/admin/kategori-klinis/{kategoriKlinis}', [KategoriKlinisController::class, 'update'])->name('admin.kategori-klinis.update');
    Route::delete('/admin/kategori-klinis/{kategoriKlinis}', [KategoriKlinisController::class, 'destroy'])->name('admin.kategori-klinis.destroy');

    // Routes untuk Kode Tindakan/Terapi Management (Admin bisa CRUD)
    Route::get('/admin/kode-tindakan', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan.index');
    Route::post('/admin/kode-tindakan', [KodeTindakanTerapiController::class, 'store'])->name('admin.kode-tindakan.store');
    Route::get('/admin/kode-tindakan/{kodeTindakan}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('admin.kode-tindakan.edit');
    Route::put('/admin/kode-tindakan/{kodeTindakan}', [KodeTindakanTerapiController::class, 'update'])->name('admin.kode-tindakan.update');
    Route::delete('/admin/kode-tindakan/{kodeTindakan}', [KodeTindakanTerapiController::class, 'destroy'])->name('admin.kode-tindakan.destroy');
});

// ============= AKSES DOKTER =============
Route::middleware(['isDokter'])->group(function () {
    // Dashboard Dokter
    Route::get('/dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
    
    // Rekam Medis (Read Only)
    Route::get('/dokter/rekam-medis', [DokterController::class, 'rekamMedis'])->name('dokter.rekam-medis');
    Route::get('/dokter/rekam-medis/{id}', [DokterController::class, 'detailRekamMedis'])->name('dokter.detail-rekam-medis');
});

// ============= AKSES PERAWAT =============
Route::middleware(['isPerawat'])->group(function () {
    // Dashboard Perawat
    Route::get('/perawat/dashboard', [PerawatController::class, 'dashboard'])->name('perawat.dashboard');
    
    // Rekam Medis - CRUD
    Route::get('/perawat/rekam-medis', [PerawatController::class, 'rekamMedis'])->name('perawat.rekam-medis');
    Route::get('/perawat/rekam-medis/tambah/{idreservasi}', [PerawatController::class, 'tambahRekamMedis'])->name('perawat.tambah-rekam-medis');
    Route::post('/perawat/rekam-medis', [PerawatController::class, 'storeRekamMedis'])->name('perawat.rekam-medis.store');
    Route::get('/perawat/rekam-medis/{id}', [PerawatController::class, 'detailRekamMedis'])->name('perawat.detail-rekam-medis');
    Route::get('/perawat/rekam-medis/{id}/edit', [PerawatController::class, 'editRekamMedis'])->name('perawat.edit-rekam-medis');
    Route::put('/perawat/rekam-medis/{id}', [PerawatController::class, 'updateRekamMedis'])->name('perawat.rekam-medis.update');
    Route::delete('/perawat/rekam-medis/{id}', [PerawatController::class, 'deleteRekamMedis'])->name('perawat.rekam-medis.delete');
    
    // Detail Rekam Medis (Tindakan Terapi) - CRUD
    Route::post('/perawat/detail-rekam-medis', [PerawatController::class, 'storeDetailRekamMedis'])->name('perawat.detail-rekam-medis.store');
    Route::get('/perawat/detail-rekam-medis/{id}/edit', [PerawatController::class, 'editDetailRekamMedis'])->name('perawat.detail-rekam-medis.edit');
    Route::put('/perawat/detail-rekam-medis/{id}', [PerawatController::class, 'updateDetailRekamMedis'])->name('perawat.detail-rekam-medis.update');
    Route::delete('/perawat/detail-rekam-medis/{id}', [PerawatController::class, 'deleteDetailRekamMedis'])->name('perawat.detail-rekam-medis.delete');
});

// ============= AKSES RESEPSIONIS =============
Route::middleware(['isResepsionis'])->group(function () {
    // Dashboard Resepsionis
    Route::get('/resepsionis/dashboard', [ResepsionisController::class, 'dashboard'])->name('resepsionis.dashboard');
    
    // Tambah Pemilik
    Route::get('/resepsionis/tambah-pemilik', [ResepsionisController::class, 'tambahPemilik'])->name('resepsionis.tambah-pemilik');
    Route::post('/resepsionis/pemilik', [ResepsionisController::class, 'storePemilik'])->name('resepsionis.pemilik.store');
    
    // Tambah Pet
    Route::get('/resepsionis/tambah-pet', [ResepsionisController::class, 'tambahPet'])->name('resepsionis.tambah-pet');
    Route::post('/resepsionis/pet', [ResepsionisController::class, 'storePet'])->name('resepsionis.pet.store');
    
    // Temu Dokter
    Route::get('/resepsionis/temu-dokter', [ResepsionisController::class, 'temuDokter'])->name('resepsionis.temu-dokter');
    Route::post('/resepsionis/temu-dokter', [ResepsionisController::class, 'storeTemuDokter'])->name('resepsionis.temu-dokter.store');
    Route::post('/resepsionis/temu-dokter', [ResepsionisController::class, 'storeTemuDokter'])->name('resepsionis.store-temu-dokter');
});

// ============= AKSES PEMILIK =============
Route::middleware(['isPemilik'])->group(function () {
    // Route untuk dashboard pemilik
    Route::get('/pemilik/dashboard', [PemilikController::class, 'index'])->name('pemilik.dashboard');
    
    // Route untuk daftar pet pemilik
    Route::get('/pemilik/daftar-pet', [PemilikController::class, 'getPetList'])->name('pemilik.daftar-pet');
    
    // Route untuk reservasi pemilik
    Route::get('/pemilik/daftar-reservasi', [PemilikController::class, 'getReservasiList'])->name('pemilik.reservasi');
    
    // Route untuk rekam medis pemilik
    Route::get('/pemilik/daftar-rekam-medis', [PemilikController::class, 'getRekamMedisList'])->name('pemilik.rekam-medis');
    Route::get('/pemilik/rekam-medis/{id}', [PemilikController::class, 'getRekamMedisDetail'])->name('pemilik.rekam-medis.detail');
    
    // Route untuk profile pemilik
    Route::get('/pemilik/profile', [PemilikController::class, 'showProfile'])->name('pemilik.profile');
    Route::post('/pemilik/profile', [PemilikController::class, 'updateProfile'])->name('pemilik.profile.update');
});