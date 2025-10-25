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
                            <td class="col-id">{{ $user->id }}</td>
                            
                            <!-- Nama User -->
                            <td class="col-name">{{ $user->name }}</td>
                            
                            <!-- Role Saat Ini -->
                            <td class="col-role">
                                <div class="role-info">
                                    @forelse($user->roles as $role)
                                        @if($role->pivot->status == 1)
                                            <span class="role-active">{{ $role->nama_role }} (Aktif)</span><br>
                                        @else
                                            <span class="role-inactive">{{ $role->nama_role }} (Non-Aktif)</span><br>
                                        @endif
                                    @empty
                                        <span class="no-role">Belum ada role</span>
                                    @endforelse
                                </div>
                            </td>
                            
                            <!-- Form Kelola Role - DISABLED -->
                            <td class="col-action">
                                {{-- CRUD DISABLED: Form assign role dinonaktifkan sementara --}}
                                {{-- 
                                <form method="POST" action="{{ route('admin.role.assign') }}" class="role-assign-form">
                                    @csrf
                                    <input type="hidden" name="iduser" value="{{ $user->id }}">
                                    
                                    <select name="idrole" required class="form-select">
                                        @foreach($allRoles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->nama_role }}
                                        </option>
                                        @endforeach
                                    </select>
                                    
                                    <select name="status" required class="form-select">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                    </select>
                                    
                                    <button type="submit" class="btn-action">Tambah Role</button>
                                </form>
                                --}}
                                <span style="color: #9ca3af; font-style: italic;">View Only</span>
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