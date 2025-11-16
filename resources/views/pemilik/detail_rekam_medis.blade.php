@include('layouts.pemilik.head')

<link rel="stylesheet" href="{{ asset('css/pemilik/style_daftar_reservasi.css') }}">

@include('layouts.pemilik.header')
                <a href="{{ route('pemilik.daftar-pet') }}"><i class="fas fa-paw"></i> Daftar Pet</a>
                <a href="{{ route('pemilik.reservasi') }}"><i class="fas fa-calendar"></i> Reservasi</a>
                <a href="{{ route('pemilik.rekam-medis') }}" class="active"><i class="fas fa-file-medical"></i> Rekam Medis</a>
            </nav>
        </div>
    </header>

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
                                            <span class="therapy-name">{{ $detail->kodeTindakanTerapi->nama_tindakan ?? '-' }}</span>
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
