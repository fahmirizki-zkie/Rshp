@include('layouts.perawat.head')

<style>
    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px 20px;
    }

    .container h1 {
        color: #1f2937;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #3b82f6;
    }

    .info-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .info-card h3 {
        color: #ffffff;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-card h3::before {
        content: "ℹ️";
        font-size: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }

    .info-item {
        background: rgba(255, 255, 255, 0.95);
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .info-item strong {
        color: #1f2937;
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
    }

    .form-container {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        color: #1f2937;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 8px;
    }

    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        color: #374151;
        transition: all 0.3s ease;
        resize: vertical;
        line-height: 1.6;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-group textarea::placeholder {
        color: #9ca3af;
    }

    .form-help {
        display: block;
        margin-top: 6px;
        color: #6b7280;
        font-size: 13px;
        font-style: italic;
    }

    .error-message {
        display: block;
        color: #ef4444;
        font-size: 13px;
        margin-top: 6px;
        font-weight: 500;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 2px solid #f3f4f6;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        box-shadow: 0 6px 8px rgba(16, 185, 129, 0.4);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(107, 114, 128, 0.3);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
        box-shadow: 0 6px 8px rgba(107, 114, 128, 0.4);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px 15px;
        }

        .container h1 {
            font-size: 24px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .form-container {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

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
