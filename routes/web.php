<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\siteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;


// Main page routes
Route::get('/', [SiteController::class, 'index'])->name('site.cek-koneksi');
Route::get('/p', [SiteController::class, 'index'])->name('home');

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
    Route::get('/data-pemilik', [PemilikController::class, 'dataPemilik'])->name('admin.pemilik.index');
    Route::get('/admin/pemilik/{iduser}/edit', [PemilikController::class, 'edit'])->name('admin.pemilik.edit');
    Route::delete('/admin/pemilik/{idpemilik}', [PemilikController::class, 'destroy'])->name('admin.pemilik.destroy');

    // Routes untuk User Management (VIEW ONLY - CRUD DISABLED)
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');

    // CRUD Routes - Disabled for now (hanya view yang aktif)
    // Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    // Route::post('/admin/user', [UserController::class, 'store'])->name('admin.user.store');
    // Route::get('/admin/user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    // Route::put('/admin/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
    // Route::get('/admin/user/{user}/reset-password', [UserController::class, 'showResetPassword'])->name('admin.user.reset-password');
    // Route::put('/admin/user/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.user.reset-password.update');
    // Route::delete('/admin/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

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

// ============= AKSES RESEPSIONIS =============
Route::middleware(['isResepsionis'])->group(function () {
    // Routes untuk Resepsionis
    Route::get('/resepsionis/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
    Route::get('/resepsionis/tambah-pemilik', function() {
        return redirect()->back()->with('info', 'Fitur tambah pemilik belum diimplementasikan');
    })->name('resepsionis.tambah-pemilik');
});

// ============= AKSES PEMILIK =============
Route::middleware(['isPemilik'])->group(function () {
    // Route untuk pemilik (Customer view)
    Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
