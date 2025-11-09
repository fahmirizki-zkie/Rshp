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
            
            <!-- ========== FORM SECTION ========== -->
            <div class="form-container">
                <form action="{{ route('admin.role.store') }}" method="POST" class="role-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama_role">Nama Role <span style="color: red;">*</span></label>
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
                        <a href="{{ route('admin.role.daftar') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
