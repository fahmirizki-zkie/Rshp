{{-- 
    TAMBAH ROLE - VIEW ONLY MODE (DISABLED)
    ========================================
    Halaman ini untuk menambahkan role baru ke sistem.
    Fitur ini dinonaktifkan sementara (VIEW ONLY MODE).
    
    Untuk mengaktifkan:
    1. Uncomment method createRole() dan storeRole() di RoleController.php
    2. Uncomment routes di web.php
    3. Uncomment form di view ini
--}}
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Role - Admin RSHP</title>
	<link rel="stylesheet" href="{{ asset('css/admin/style_manajemen_role_new.css') }}">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Tambah Role Baru</h1>
                <p class="page-subtitle">Tambahkan role/peran baru ke dalam sistem.</p>
            </div>
            
            <!-- ========== FORM SECTION - DISABLED ========== -->
            <div class="form-container">
                {{-- CRUD DISABLED: Form tambah role dinonaktifkan sementara --}}
                {{-- 
                <form action="{{ route('admin.role.store') }}" method="POST" class="role-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama_role">Nama Role</label>
                        <input type="text" 
                               id="nama_role" 
                               name="nama_role" 
                               value="{{ old('nama_role') }}" 
                               required 
                               maxlength="50"
                               class="form-control @error('nama_role') is-invalid @enderror"
                               placeholder="Contoh: Administrator, Resepsionis, Dokter">
                        @error('nama_role')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Role (Opsional)</label>
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  rows="4" 
                                  maxlength="255"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Deskripsi singkat tentang role ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="button-section">
                        <button type="submit" class="btn btn-primary">Simpan Role</button>
                        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                --}}
                
                <!-- VIEW ONLY MESSAGE -->
                <div class="alert alert--info" style="margin-top: 20px; padding: 20px; background: #f0f9ff; border: 2px solid #0ea5e9; border-radius: 8px;">
                    <h3 style="margin-bottom: 10px; color: #0369a1;">⚠️ Fitur Tidak Aktif</h3>
                    <p style="color: #0c4a6e;">Halaman ini dalam mode <strong>VIEW ONLY</strong>. Fitur tambah role baru sementara dinonaktifkan sesuai ketentuan tugas.</p>
                    <p style="color: #0c4a6e; margin-top: 10px;">
                        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Kembali ke Manajemen Role</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
