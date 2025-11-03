<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemilik - Resepsionis RS Hewan UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/resepsionis/style_resepsionis.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="nav-content">
        <div class="logokiri">
            <img src="{{ asset('img/unairr.png') }}" alt="Logo UNAIR">
        </div>
        <div class="text">
            <h2>Universitas Airlangga |</h2>
        </div>
        <div class="text2">
            <h2>Rumah Sakit Hewan Pendidikan</h2>
        </div>
        <div class="logokanan">
            <img src="{{ asset('img/rshpp.png') }}" alt="Logo RSHP">
        </div>
    </div>

    <div class="navbar">
        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>
        <div class="navbar-nav">
            <a href="{{ route('resepsionis.dashboard') }}">Back</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Tambah Data Pemilik</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

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
</body>
</html>
