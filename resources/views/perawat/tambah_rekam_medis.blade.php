@include('layouts.perawat.head')

<link rel="stylesheet" href="{{ asset('css/st.css') }}">

@include('layouts.perawat.header')
@include('layouts.perawat.navbar')

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
</div>

@include('layouts.perawat.footer')
@include('layouts.perawat.scripts')
