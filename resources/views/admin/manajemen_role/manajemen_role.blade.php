<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Role - Admin RSHP</title>
	<link rel="stylesheet" href="{{ asset('css/admin/style_manajemen_role_new.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTENT ========== -->
    <div class="container">
        <!-- ========== MAIN CONTENT WRAPPER ========== -->
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Manajemen Role</h1>
                <p class="page-subtitle">Kelola peran pengguna sistem. Hanya administrator yang dapat mengakses halaman ini.</p>
            </div>
            
            <!-- ========== BUTTON SECTION ========== -->
            <div class="button-section">
                <a href="{{ route('admin.role.daftar') }}" class="btn btn-primary">📋 Lihat Daftar Role</a>
                <a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
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
            
            <!-- ========== TABEL MANAJEMEN ROLE ========== -->
            <div class="table-container">
                <table class="data-table">
                    <!-- Header tabel -->
                    <thead>
                        <tr>
                            <th class="col-id">ID USER</th>
                            <th class="col-name">NAMA LENGKAP</th>
                            <th class="col-role">ROLE SAAT INI</th>
                            <th class="col-action">AKSI</th>
                        </tr>
                    </thead>
                    
                    <!-- Data rows -->
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <!-- ID User -->
                            <td class="col-id">{{ $user->iduser }}</td>
                            
                            <!-- Nama User -->
                            <td class="col-name">{{ $user->nama }}</td>
                            
                            <!-- Role Saat Ini -->
                            <td class="col-role">
                                <div class="role-info">
                                    @forelse($user->roles as $role)
                                        <div style="margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                                            @if($role->pivot->status == 1)
                                                <span class="role-active">{{ $role->nama_role }} (Aktif)</span>
                                            @else
                                                <span class="role-inactive">{{ $role->nama_role }} (Non-Aktif)</span>
                                            @endif
                                            
                                            <!-- Tombol Ubah Status -->
                                            <form method="POST" action="{{ route('admin.role.update-status', $role->pivot->idrole_user) }}" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="{{ $role->pivot->status == 1 ? 0 : 1 }}">
                                                <button type="submit" class="btn-action" style="font-size: 12px; padding: 4px 8px;">
                                                    {{ $role->pivot->status == 1 ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                            
                                            <!-- Tombol Hapus -->
                                            <form method="POST" action="{{ route('admin.role.remove', $role->pivot->idrole_user) }}" style="display: inline;" onsubmit="return confirm('Yakin hapus role {{ $role->nama_role }} dari user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action" style="font-size: 12px; padding: 4px 8px; background: #ef4444;">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @empty
                                        <span class="no-role">Belum ada role</span>
                                    @endforelse
                                </div>
                            </td>
                            
                            <!-- Aksi -->
                            <td class="col-action">
                                <!-- Form Tambah Role ke User -->
                                <form method="POST" action="{{ route('admin.role.assign') }}" style="display: flex; gap: 8px; align-items: center;">
                                    @csrf
                                    <input type="hidden" name="iduser" value="{{ $user->iduser }}">
                                    
                                    <select name="idrole" required style="padding: 6px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 13px;">
                                        <option value="">-- Pilih Role --</option>
                                        @foreach($allRoles as $role)
                                            @php
                                                // Cek apakah user sudah punya role ini
                                                $hasRole = $user->roles->contains('idrole', $role->idrole);
                                            @endphp
                                            @if(!$hasRole)
                                                <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    
                                    <select name="status" required style="padding: 6px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 13px;">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                    </select>
                                    
                                    <button type="submit" class="btn-action" style="font-size: 13px; padding: 6px 12px; background: #10b981; white-space: nowrap;">
                                        + Tambah
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <!-- Pesan jika tidak ada data -->
                        <tr class="empty-row">
                            <td colspan="4">Belum ada data pengguna.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- END MAIN CONTENT WRAPPER -->
        </div>
    </div>
</body>
</html>