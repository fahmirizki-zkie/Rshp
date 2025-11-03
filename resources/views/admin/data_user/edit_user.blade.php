<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Administrator</title>
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_user.css') }}">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <p class="page-info">Edit nama dan email user</p>

        <div class="form-container">
            <form method="POST" action="{{ route('admin.user.update', $user->iduser) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" required>
                    @error('nama')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Update</button>
                    <a href="{{ route('admin.user.index') }}" class="btn secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
