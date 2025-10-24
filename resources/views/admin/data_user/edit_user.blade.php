<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Administrator</title>
    
    <!-- CSS khusus untuk data user -->
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_user.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTAINER ========== -->
    <div class="container">
        <!-- ========== HEADER SECTION ========== -->
        <h2>Edit User</h2>
        <p class="page-info">Edit informasi user.</p>
        
        <!-- ========== FORM SECTION ========== -->
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="user-form">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
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
                       value="{{ old('email', $user->email) }}" 
                       required 
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="action-bar">
                <button type="submit" class="btn">Update User</button>
                <a href="{{ route('admin.user.index') }}" class="btn">Batal</a>
            </div>
        </form>
        
        <!-- ========== DELETE SECTION ========== -->
        <div class="danger-zone">
            <h3>Danger Zone</h3>
            <p>Hapus user ini secara permanen dari sistem.</p>
            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete">Hapus User</button>
            </form>
        </div>
    </div>
</body>
</html>
