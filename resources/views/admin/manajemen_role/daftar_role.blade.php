<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Role - Admin RSHP</title>
    <link rel="stylesheet" href="{{ asset('css/admin/style_daftar_role.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTENT ========== -->
    <div class="container">
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Daftar Role Sistem</h1>
                <p class="page-subtitle">Kelola role yang tersedia dalam sistem.</p>
            </div>
            
            <!-- ========== BUTTON SECTION ========== -->
            <div class="button-section">
                <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Kembali ke Manajemen Role</a>
            </div>
            
            <!-- ========== ALERT MESSAGES ========== -->
            @if(session('success'))
            <div class="alert alert--success">
                {{ session('success') }}
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert--error">
                {{ session('error') }}
            </div>
            @endif
            
            <!-- ========== FORM TAMBAH ROLE ========== -->
            <div class="add-form-section">
                <h3 class="form-title">Tambah Role Baru</h3>
                <form class="form-horizontal" method="POST" action="{{ route('admin.role.store') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama_role" class="form-label">Nama Role <span class="required">*</span></label>
                        <input type="text" 
                               id="nama_role"
                               name="nama_role" 
                               value="{{ old('nama_role') }}"
                               placeholder="Contoh: Dokter, Perawat" 
                               required 
                               maxlength="50"
                               class="form-input @error('nama_role') input-error @enderror" />
                        @error('nama_role')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi"
                                  name="deskripsi" 
                                  rows="3" 
                                  placeholder="Deskripsi role (opsional)"
                                  maxlength="255"
                                  class="form-textarea @error('deskripsi') input-error @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-add">+ Tambah Role</button>
                    </div>
                </form>
            </div>
            
            <!-- ========== TABEL DATA ROLE ========== -->
            <div class="table-container">
                <table class="data-table">
                    <!-- Header tabel -->
                    <thead>
                        <tr>
                            <th class="col-id">ID</th>
                            <th class="col-name">NAMA ROLE</th>
                            <th class="col-desc">DESKRIPSI</th>
                            <th class="col-users">JUMLAH USER</th>
                            <th class="col-action">AKSI</th>
                        </tr>
                    </thead>
                    
                    <!-- Data rows -->
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <!-- ID Role -->
                            <td class="col-id">{{ $role->idrole }}</td>
                            
                            <!-- Nama Role -->
                            <td class="col-name">
                                <strong>{{ $role->nama_role }}</strong>
                            </td>
                            
                            <!-- Deskripsi -->
                            <td class="col-desc">{{ $role->deskripsi ?? '-' }}</td>
                            
                            <!-- Jumlah User yang pakai role ini -->
                            <td class="col-users">
                                <span class="badge badge-info">{{ $role->users()->count() }} user</span>
                            </td>
                            
                            <!-- Tombol Aksi -->
                            <td class="col-action">
                                @if($role->users()->count() > 0)
                                    <span class="text-muted" title="Role tidak bisa dihapus karena masih digunakan">
                                        🔒 Tidak bisa dihapus
                                    </span>
                                @else
                                    <!-- Form Hapus -->
                                    <form method="POST" 
                                          action="{{ route('admin.role.destroy', $role->idrole) }}" 
                                          class="delete-form"
                                          onsubmit="return confirm('Yakin ingin menghapus role {{ $role->nama_role }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="5">Belum ada data role. Silakan tambah role baru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
