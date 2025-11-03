<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail Rekam Medis - Perawat RS Hewan UNAIR</title>
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
            <a href="{{ route('perawat.detail-rekam-medis', $detailRekamMedis->idrekam_medis) }}">Back</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Edit Detail Rekam Medis</h1>

        <div class="info-card">
            <h3>Informasi Detail Terapi</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Kategori Klinis:</strong> 
                    {{ $detailRekamMedis->kodeTindakanTerapi->kategoriKlinis->nama ?? '-' }}
                </div>
                <div class="info-item">
                    <strong>Kategori Tindakan:</strong> 
                    {{ $detailRekamMedis->kodeTindakanTerapi->kategori->nama ?? '-' }}
                </div>
                <div class="info-item">
                    <strong>Kode Tindakan:</strong> 
                    {{ $detailRekamMedis->kodeTindakanTerapi->kode ?? '-' }}
                </div>
            </div>
        </div>

        <form action="{{ route('perawat.detail-rekam-medis.update', $detailRekamMedis->iddetail_rekam_medis) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="idkode_tindakan_terapi">Kode Tindakan Terapi:</label>
                <select name="idkode_tindakan_terapi" id="idkode_tindakan_terapi" required>
                    <option value="">-- Pilih Tindakan Terapi --</option>
                    @foreach($kodeTindakanTerapi as $kode)
                        <option value="{{ $kode->idkode_tindakan_terapi }}" 
                            {{ old('idkode_tindakan_terapi', $detailRekamMedis->idkode_tindakan_terapi) == $kode->idkode_tindakan_terapi ? 'selected' : '' }}>
                            {{ $kode->kode }} - {{ $kode->nama_tindakan }} 
                            ({{ $kode->kategoriKlinis->nama ?? '' }} - {{ $kode->kategori->nama ?? '' }})
                        </option>
                    @endforeach
                </select>
                @error('idkode_tindakan_terapi')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="detail">Detail Tindakan:</label>
                <textarea name="detail" id="detail" rows="4" 
                          placeholder="Masukkan detail tindakan terapi yang dilakukan..." 
                          required>{{ old('detail', $detailRekamMedis->detail) }}</textarea>
                <small class="form-help">
                    Catatan: Jelaskan detail pelaksanaan tindakan terapi ini
                </small>
                @error('detail')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Detail</button>
                <a href="{{ route('perawat.detail-rekam-medis', $detailRekamMedis->idrekam_medis) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
