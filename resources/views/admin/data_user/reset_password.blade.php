<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Administrator</title>
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_user.css') }}">
</head>
<body>
    <div class="container">
        <h2>Reset Password User</h2>
        <p class="page-info">Reset password untuk user: <strong>{{ $user->nama }}</strong></p>

        <div class="form-container">
            <form method="POST" action="{{ route('admin.user.reset-password.update', $user->iduser) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="password">Password Baru <span class="required">*</span></label>
                    <input type="password" name="password" id="password" required>
                    <small>Minimal 8 karakter</small>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password <span class="required">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Reset Password</button>
                    <a href="{{ route('admin.user.index') }}" class="btn secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
