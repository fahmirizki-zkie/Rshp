<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Administrator</title>
    
    <!-- CSS khusus untuk data user -->
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_user.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTAINER ========== -->
    <div class="container">
        <!-- ========== HEADER SECTION ========== -->
        <h2>Tambah User Baru</h2>
        <p class="page-info">Tambahkan user baru ke dalam sistem.</p>
        
        <!-- ========== FORM SECTION ========== -->
        <form action="{{ route('admin.user.store') }}" method="POST" class="user-form">
            @csrf
            
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required 
                       class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required 
                       class="form-control">
            </div>
            
            <div class="action-bar">
                <button type="submit" class="btn">Simpan User</button>
                <a href="{{ route('admin.user.index') }}" class="btn">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
