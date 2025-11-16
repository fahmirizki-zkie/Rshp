@include('layouts.perawat.head')

<style>
    .container {
        max-width: 1200px;
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
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
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
        content: "📄";
        font-size: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 15px;
        margin-bottom: 15px;
    }

    .info-section {
        display: flex;
        flex-direction: column;
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

    .info-item p {
        margin: 8px 0 0 0;
        line-height: 1.6;
        color: #4b5563;
    }

    .section {
        background: #ffffff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.05);
    }

    .section h2 {
        color: #1f2937;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e5e7eb;
    }

    .form-inline {
        display: grid;
        grid-template-columns: 1fr 2fr auto;
        gap: 15px;
        margin-bottom: 25px;
        padding: 20px;
        background: #f9fafb;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .form-group select,
    .form-group input[type="text"] {
        padding: 10px 12px;
        border: 2px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        color: #374151;
        transition: all 0.3s ease;
        background-color: white;
    }

    .form-group select:focus,
    .form-group input[type="text"]:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    thead {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    thead th {
        padding: 14px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tbody tr {
        border-bottom: 1px solid #e5e7eb;
        transition: background-color 0.2s ease;
    }

    tbody tr:hover {
        background-color: #f9fafb;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    tbody td {
        padding: 12px;
        font-size: 14px;
        color: #374151;
    }

    .no-data {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
        font-size: 15px;
        font-style: italic;
        background: #f9fafb;
        border-radius: 8px;
        border: 2px dashed #d1d5db;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        align-self: flex-end;
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

    .btn-edit {
        padding: 8px 16px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        margin-right: 8px;
        box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        box-shadow: 0 4px 6px rgba(245, 158, 11, 0.4);
        transform: translateY(-1px);
    }

    .btn-delete {
        padding: 8px 16px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        box-shadow: 0 4px 6px rgba(239, 68, 68, 0.4);
        transform: translateY(-1px);
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

        .form-inline {
            grid-template-columns: 1fr;
        }

        .section {
            padding: 20px 15px;
        }

        table {
            font-size: 13px;
        }

        thead th,
        tbody td {
            padding: 10px 8px;
        }

        .btn-edit,
        .btn-delete {
            display: block;
            margin: 5px 0;
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
    <h1>Detail Rekam Medis</h1>

    <div class="info-card">
        <h3>Informasi Rekam Medis</h3>
        <div class="info-grid">
            <div class="info-item">
                <strong>No. Rekam Medis:</strong> 
                {{ $rekamMedis->idrekam_medis }}
            </div>
            <div class="info-item">
                <strong>Tanggal:</strong> 
                {{ \Carbon\Carbon::parse($rekamMedis->tanggal_rekam_medis)->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <strong>No. Urut Antrian:</strong> 
                {{ $rekamMedis->temuDokter->no_urut ?? '-' }}
            </div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <strong>Nama Pet:</strong> 
                {{ $rekamMedis->temuDokter->pet->nama ?? '-' }}
            </div>
            <div class="info-item">
                <strong>Pemilik:</strong> 
                {{ $rekamMedis->temuDokter->pet->pemilik->user->nama ?? '-' }}
            </div>
            <div class="info-item">
                <strong>Dokter Pemeriksa:</strong> 
                {{ $rekamMedis->dokter->nama ?? '-' }}
            </div>
        </div>

        <div class="info-section">
            <div class="info-item">
                <strong>Anamnesa:</strong>
                <p>{{ $rekamMedis->anamnesa ?? '-' }}</p>
            </div>
            <div class="info-item">
                <strong>Temuan Klinis:</strong>
                <p>{{ $rekamMedis->temuan_klinis ?? '-' }}</p>
            </div>
            <div class="info-item">
                <strong>Diagnosa:</strong>
                <p>{{ $rekamMedis->diagnosa ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Detail Tindakan Terapi</h2>
        
        <form action="{{ route('perawat.detail-rekam-medis.store') }}" method="POST" class="form-inline">
            @csrf
            <input type="hidden" name="idrekam_medis" value="{{ $rekamMedis->idrekam_medis }}">
            
            <div class="form-group">
                <label for="idkode_tindakan_terapi">Pilih Tindakan:</label>
                <select name="idkode_tindakan_terapi" id="idkode_tindakan_terapi" required>
                    <option value="">-- Pilih Tindakan --</option>
                    @foreach($kodeTindakanTerapi as $kode)
                        <option value="{{ $kode->idkode_tindakan_terapi }}">
                            {{ $kode->kode }} - {{ $kode->deskripsi_tindakan_terapi }} ({{ $kode->kategoriKlinis->nama ?? '' }} - {{ $kode->kategori->nama ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="detail">Detail:</label>
                <input type="text" name="detail" id="detail" placeholder="Detail tindakan..." required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

        @if($rekamMedis->detailRekamMedis->isEmpty())
            <p class="no-data">Belum ada detail tindakan terapi.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Tindakan</th>
                        <th>Kategori Klinis</th>
                        <th>Kategori</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedis->detailRekamMedis as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->kode ?? '-' }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama ?? '-' }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->kategori->nama ?? '-' }}</td>
                            <td>{{ $detail->detail ?? '-' }}</td>
                            <td>
                                <a href="{{ route('perawat.detail-rekam-medis.edit', $detail->iddetail_rekam_medis) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('perawat.detail-rekam-medis.delete', $detail->iddetail_rekam_medis) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus detail ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</div>

@include('layouts.perawat.footer')
@include('layouts.perawat.scripts')
