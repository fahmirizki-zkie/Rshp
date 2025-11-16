@include('layouts.resepsionis.head')

<link rel="stylesheet" href="{{ asset('css/resepsionis/style_resepsionis.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}">

@include('layouts.resepsionis.header')
@include('layouts.resepsionis.navbar')

<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:enter="slideDown" x-transition:leave="slideUp">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:enter="slideDown" x-transition:leave="slideUp">
            {{ session('error') }}
        </div>
    @endif
<div class="container">
    <h1>Tambah Data Pemilik</h1>

    <div class="form-box">
        <form method="POST" action="{{ route('resepsionis.pemilik.store') }}">
            @csrf

            <div class="form-group">
                <label for="iduser">Pilih User <span class="required">*</span></label>
                <select name="iduser" id="iduser" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                            {{ $user->iduser }} - {{ $user->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="form-help">Catatan: Pilih user yang akan dijadikan pemilik hewan</small>
                @error('iduser')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_whatsapp">No WhatsApp <span class="required">*</span></label>
                <input type="text" name="no_whatsapp" id="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="Contoh: 081234567890" required>
                <small class="form-help">Catatan: Masukkan nomor WhatsApp aktif untuk komunikasi</small>
                @error('no_whatsapp')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat <span class="required">*</span></label>
                <textarea name="alamat" id="alamat" rows="4" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                <small class="form-help">Catatan: Alamat lengkap untuk keperluan administrasi dan komunikasi</small>
                @error('alamat')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Data Pemilik</button>
                <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>

@include('layouts.resepsionis.footer')
@include('layouts.resepsionis.scripts')
