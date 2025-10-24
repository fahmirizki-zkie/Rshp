<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Administrator</title>
    
    <!-- CSS khusus untuk data user -->
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_user.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTAINER ========== -->
    <div class="container">
        <!-- ========== HEADER SECTION ========== -->
        <h2>Reset Password User</h2>
        <p class="page-info">Reset password untuk user: <strong>{{ $user->name }}</strong></p>
        
        <!-- ========== FORM SECTION ========== -->
        <form action="{{ route('admin.user.reset-password.update', $user->id) }}" method="POST" class="user-form">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="password">Password Baru</label>
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
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required 
                       class="form-control">
            </div>
            
            <div class="action-bar">
                <button type="submit" class="btn">Reset Password</button>
                <a href="{{ route('admin.user.index') }}" class="btn">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
