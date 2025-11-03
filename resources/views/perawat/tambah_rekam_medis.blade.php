<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rekam Medis - Perawat RS Hewan UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/st.css') }}">
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
            <a href="{{ route('perawat.rekam-medis') }}">Back</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Tambah Rekam Medis</h1>

        <div class="info-card">
            <h3>Informasi Temu Dokter</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>No. Urut:</strong> 
                    {{ $temuDokter->no_urut }}
                </div>
                <div class="info-item">
                    <strong>Tanggal/Waktu:</strong> 
                    {{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d/m/Y H:i') }}
                </div>
                <div class="info-item">
                    <strong>Nama Pet:</strong> 
                    {{ $temuDokter->pet->nama }}
                </div>
                <div class="info-item">
                    <strong>Pemilik:</strong> 
                    {{ $temuDokter->pet->pemilik->user->nama }}
                </div>
                <div class="info-item">
                    <strong>Dokter:</strong> 
                    {{ $temuDokter->roleUser->user->nama }}
                </div>
            </div>
        </div>

        <form action="{{ route('perawat.rekam-medis.store') }}" method="POST" class="form-container">
            @csrf
            <input type="hidden" name="idreservasi_dokter" value="{{ $temuDokter->idreservasi_dokter }}">
            <input type="hidden" name="dokter_pemeriksa" value="{{ $temuDokter->roleUser->iduser }}">
            
            <div class="form-group">
                <label for="anamnesa">Anamnesa (Wawancara Medis):</label>
                <textarea name="anamnesa" id="anamnesa" rows="4" 
                          placeholder="Masukkan hasil wawancara medis dengan pemilik hewan..." 
                          required>{{ old('anamnesa') }}</textarea>
                <small class="form-help">
                    Catatan: Isi dengan riwayat keluhan dan informasi yang diberikan pemilik tentang kondisi hewan
                </small>
                @error('anamnesa')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="temuan_klinis">Temuan Klinis:</label>
                <textarea name="temuan_klinis" id="temuan_klinis" rows="4" 
                          placeholder="Masukkan temuan klinis dari pemeriksaan..." 
                          required>{{ old('temuan_klinis') }}</textarea>
                <small class="form-help">
                    Catatan: Isi dengan hasil pemeriksaan fisik dan observasi klinis pada hewan
                </small>
                @error('temuan_klinis')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="diagnosa">Diagnosa:</label>
                <textarea name="diagnosa" id="diagnosa" rows="3" 
                          placeholder="Masukkan diagnosa berdasarkan pemeriksaan..." 
                          required>{{ old('diagnosa') }}</textarea>
                <small class="form-help">
                    Catatan: Isi dengan kesimpulan diagnosa berdasarkan anamnesa dan temuan klinis
                </small>
                @error('diagnosa')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Rekam Medis</button>
                <a href="{{ route('perawat.rekam-medis') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
