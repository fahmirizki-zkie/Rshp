<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pet - Resepsionis RS Hewan UNAIR</title>
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
        <h1>Tambah Data Pet</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="form-box">
            <form method="POST" action="{{ route('resepsionis.pet.store') }}">
                @csrf

                <div class="form-group">
                    <label for="idpemilik">Pilih Pemilik <span class="required">*</span></label>
                    <select name="idpemilik" id="idpemilik" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach($pemilikList as $pemilik)
                            <option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>
                                {{ $pemilik->user->nama ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-help">Catatan: Pilih pemilik yang sudah terdaftar di sistem</small>
                    @error('idpemilik')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="idras_hewan">Ras Hewan <span class="required">*</span></label>
                    <select name="idras_hewan" id="idras_hewan" required>
                        <option value="">-- Pilih Ras --</option>
                        @foreach($rasHewanList as $ras)
                            <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                                {{ $ras->jenisHewan->nama ?? '-' }} - {{ $ras->nama }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-help">Catatan: Pilih ras hewan yang sesuai</small>
                    @error('idras_hewan')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama Pet <span class="required">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Masukkan nama hewan" required>
                    <small class="form-help">Catatan: Nama hewan yang mudah diingat dan dipanggil</small>
                    @error('nama')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="">-- Pilih Kelamin --</option>
                        <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                        <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                    </select>
                    <small class="form-help">Catatan: Pilih jenis kelamin hewan</small>
                    @error('jenis_kelamin')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    <small class="form-help">Catatan: Tanggal lahir untuk menghitung umur hewan (opsional)</small>
                    @error('tanggal_lahir')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="warna">Warna/Tanda Khusus</label>
                    <textarea name="warna" id="warna" rows="3" placeholder="Contoh: Hitam putih, tanda di dahi">{{ old('warna') }}</textarea>
                    <small class="form-help">Catatan: Deskripsi warna atau tanda khusus untuk identifikasi</small>
                    @error('warna')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Data Pet</button>
                    <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
