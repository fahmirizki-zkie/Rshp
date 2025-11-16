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
        border-bottom: 3px solid #8b5cf6;
    }

    .info-card {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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
        content: "📋";
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

    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        color: #374151;
        transition: all 0.3s ease;
        background-color: white;
    }

    .form-group select {
        cursor: pointer;
    }

    .form-group textarea {
        resize: vertical;
        line-height: 1.6;
    }

    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
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
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(139, 92, 246, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        box-shadow: 0 6px 8px rgba(139, 92, 246, 0.4);
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
                        {{ $kode->kode }} - {{ $kode->deskripsi_tindakan_terapi }} 
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
</div>

@include('layouts.perawat.footer')
@include('layouts.perawat.scripts')
