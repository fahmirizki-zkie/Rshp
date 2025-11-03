<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Administrator</title>
    
    <!-- CSS khusus untuk data user -->
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_user.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTAINER ========== -->
    <div class="container">
        <!-- ========== HEADER SECTION ========== -->
        <h2>Data User</h2>
        <p class="page-info">Kelola data user sistem. Hanya administrator yang dapat mengakses halaman ini.</p>
        
        <!-- ========== ACTION BUTTONS ========== -->
        <div class="action-bar">
            <a href="{{ route('admin.user.create') }}" class="btn">+ Tambah User Baru</a>
            <a href="{{ route('admin.data-master') }}" class="btn">Kembali ke Dashboard</a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- ========== DATA TABLE ========== -->
        <table class="data-table">
            <!-- Header tabel -->
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <!-- Data rows -->
            <tbody>
                @forelse($users as $user)
                <tr>
                    <!-- ID User -->
                    <td>{{ $user->iduser }}</td>
                    
                    <!-- Nama User -->
                    <td>{{ $user->nama }}</td>
                    
                    <!-- Email User -->
                    <td>{{ $user->email }}</td>
                    
                    <!-- Action Buttons -->
                    <td>
                        <a href="{{ route('admin.user.edit', $user->iduser) }}" 
                           class="btn edit"
                           title="Edit nama user">Edit</a>
                        
                        <a href="{{ route('admin.user.reset-password', $user->iduser) }}" 
                           class="btn reset"
                           title="Reset password user">Reset Password</a>
                    </td>
                </tr>
                @empty
                <!-- Pesan jika tidak ada data -->
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px;">
                        Belum ada data user. Silakan tambah user baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>