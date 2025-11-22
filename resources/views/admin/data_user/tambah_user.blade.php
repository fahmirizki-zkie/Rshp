@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
    <div class="container">
        <h2>Tambah User Baru</h2>
        <p class="page-info">Form untuk menambahkan user baru ke sistem</p>

        <div class="form-container">
            <form method="POST" action="{{ route('admin.user.store') }}">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
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
                    <button type="submit" class="btn">Simpan</button>
                    <a href="{{ route('admin.user.index') }}" class="btn secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
