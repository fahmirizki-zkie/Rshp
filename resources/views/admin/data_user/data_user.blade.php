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
            {{-- CRUD DISABLED: Tombol tambah user dinonaktifkan sementara --}}
            {{-- <a href="{{ route('admin.user.create') }}" class="btn">+ Tambah User Baru</a> --}}
            <a href="{{ route('admin.data-master') }}" class="btn">Kembali ke Dashboard</a>
        </div>

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
                    <td>{{ $user->id }}</td>
                    
                    <!-- Nama User -->
                    <td>{{ $user->name }}</td>
                    
                    <!-- Email User -->
                    <td>{{ $user->email }}</td>
                    
                    <!-- Action Buttons -->
                    <td>
                        {{-- CRUD DISABLED: Tombol edit dan reset password dinonaktifkan sementara --}}
                        {{-- <a href="{{ route('admin.user.edit', $user->id) }}" 
                           class="btn edit"
                           title="Edit nama user">Edit Nama</a>
                        
                        <a href="{{ route('admin.user.reset-password', $user->id) }}" 
                           class="btn reset"
                           title="Reset password user">Reset Password</a> --}}
                        <span style="color: #9ca3af; font-style: italic;">View Only</span>
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