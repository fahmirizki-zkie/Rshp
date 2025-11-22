@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
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
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
