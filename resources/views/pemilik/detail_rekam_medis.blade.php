@include('layouts.pemilik.head')
<link rel="stylesheet" href="{{ asset('css/pemilik/style_daftar_pet.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_dashboard_pemilik.css') }}">
<style>
    /* Detail Rekam Medis Styles */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 3px solid #3b82f6;
    }

    .page-header h1 {
        font-size: 2rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
    }

    .btn-back {
        padding: 10px 20px;
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(107, 114, 128, 0.3);
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #4b5563, #374151);
        box-shadow: 0 6px 8px rgba(107, 114, 128, 0.4);
        transform: translateY(-2px);
    }

    .detail-card {
        background: white;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .card-section {
        padding: 30px;
        border-bottom: 2px solid #f1f5f9;
    }

    .card-section:last-child {
        border-bottom: none;
    }

    .card-section h3 {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.3rem;
        color: #1e293b;
        margin-bottom: 25px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e2e8f0;
    }

    .card-section h3 i {
        color: #3b82f6;
        font-size: 1.2rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 8px;
        border-left: 4px solid #3b82f6;
    }

    .info-item label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-item span {
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
    }

    .medical-detail {
        margin-bottom: 25px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 10px;
        border-left: 4px solid #3b82f6;
    }

    .medical-detail:last-child {
        margin-bottom: 0;
    }

    .medical-detail label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .medical-detail label i {
        color: #3b82f6;
        font-size: 1rem;
    }

    .medical-detail p {
        color: #475569;
        line-height: 1.7;
        margin: 0;
        font-size: 0.95rem;
        white-space: pre-wrap;
    }

    .no-data {
        text-align: center;
        padding: 30px;
        color: #94a3b8;
        font-style: italic;
        background: #f8fafc;
        border-radius: 8px;
        border: 2px dashed #cbd5e1;
    }

    .therapy-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .therapy-item {
        display: flex;
        gap: 15px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .therapy-item:hover {
        border-color: #3b82f6;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.1);
    }

    .therapy-number {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .therapy-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .therapy-header {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .therapy-code {
        padding: 4px 12px;
        background: #3b82f6;
        color: white;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .therapy-name {
        font-size: 1.05rem;
        font-weight: 600;
        color: #1e293b;
    }

    .therapy-meta {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .badge {
        padding: 4px 12px;
        background: #e0e7ff;
        color: #3730a3;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .therapy-detail {
        padding: 12px;
        background: white;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        color: #475569;
        line-height: 1.6;
    }

    .therapy-detail strong {
        color: #1e293b;
        font-weight: 600;
    }

    /* Footer */
    .footer {
        background: white;
        border-top: 1px solid #e2e8f0;
        padding: 20px 0;
        margin-top: 50px;
    }

    .footer p {
        text-align: center;
        color: #64748b;
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .card-section {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .therapy-item {
            flex-direction: column;
            gap: 12px;
        }

        .therapy-number {
            align-self: flex-start;
        }

        .therapy-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }
</style>

@include('layouts.pemilik.header')

    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1><i class="fas fa-file-medical"></i> Detail Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h1>
                <a href="{{ route('pemilik.rekam-medis') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="detail-card">
                <div class="card-section">
                    <h3><i class="fas fa-info-circle"></i> Informasi Umum</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Tanggal Pemeriksaan</label>
                            <span>{{ \Carbon\Carbon::parse($rekamMedis->tanggal_rekam_medis)->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <label>No. Urut Antrian</label>
                            <span>{{ $rekamMedis->temuDokter->no_urut ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <label>Nama Hewan</label>
                            <span>{{ $rekamMedis->temuDokter->pet->nama ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <label>Jenis Hewan</label>
                            <span>{{ $rekamMedis->temuDokter->pet->rasHewan->jenisHewan->nama ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <label>Ras</label>
                            <span>{{ $rekamMedis->temuDokter->pet->rasHewan->nama ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <label>Dokter Pemeriksa</label>
                            <span>{{ $rekamMedis->dokter->nama ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-section">
                    <h3><i class="fas fa-notes-medical"></i> Hasil Pemeriksaan</h3>
                    
                    <div class="medical-detail">
                        <label><i class="fas fa-comment-medical"></i> Anamnesa</label>
                        <p>{{ $rekamMedis->anamnesa ?? '-' }}</p>
                    </div>

                    <div class="medical-detail">
                        <label><i class="fas fa-stethoscope"></i> Temuan Klinis</label>
                        <p>{{ $rekamMedis->temuan_klinis ?? '-' }}</p>
                    </div>

                    <div class="medical-detail">
                        <label><i class="fas fa-diagnoses"></i> Diagnosa</label>
                        <p>{{ $rekamMedis->diagnosa ?? '-' }}</p>
                    </div>
                </div>

                <div class="card-section">
                    <h3><i class="fas fa-pills"></i> Tindakan Terapi</h3>
                    
                    @if($rekamMedis->detailRekamMedis->isEmpty())
                        <p class="no-data">Belum ada tindakan terapi yang tercatat.</p>
                    @else
                        <div class="therapy-list">
                            @foreach($rekamMedis->detailRekamMedis as $index => $detail)
                                <div class="therapy-item">
                                    <div class="therapy-number">{{ $index + 1 }}</div>
                                    <div class="therapy-info">
                                        <div class="therapy-header">
                                            <span class="therapy-code">{{ $detail->kodeTindakanTerapi->kode ?? '-' }}</span>
                                            <span class="therapy-name">{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</span>
                                        </div>
                                        <div class="therapy-meta">
                                            <span class="badge">{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama ?? '-' }}</span>
                                            <span class="badge">{{ $detail->kodeTindakanTerapi->kategori->nama ?? '-' }}</span>
                                        </div>
                                        <div class="therapy-detail">
                                            <strong>Detail:</strong> {{ $detail->detail ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} RS Hewan UNAIR. All rights reserved.</p>
        </div>
    </footer>

@include('layouts.pemilik.scripts')
