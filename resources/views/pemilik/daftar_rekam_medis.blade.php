@include('layouts.pemilik.head')

<link rel="stylesheet" href="{{ asset('css/pemilik/style_daftar_rekam_medis.css') }}">

@include('layouts.pemilik.header')

    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1><i class="fas fa-file-medical"></i> Rekam Medis</h1>
                <p>Riwayat kesehatan dan perawatan hewan peliharaan</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if($rekamMedisList->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-file-medical-alt"></i>
                    <h3>Belum Ada Rekam Medis</h3>
                    <p>Belum ada riwayat pemeriksaan kesehatan untuk hewan peliharaan Anda</p>
                </div>
            @else
                <div class="rekam-medis-list">
                    @foreach($rekamMedisList as $rekamMedis)
                        <div class="rekam-medis-card">
                            <div class="card-header">
                                <div class="rekam-number">
                                    <i class="fas fa-file-medical"></i>
                                    <span>Rekam Medis #{{ $rekamMedis->idrekam_medis }}</span>
                                </div>
                                <div class="rekam-date">
                                    {{ \Carbon\Carbon::parse($rekamMedis->tanggal_rekam_medis)->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="info-row">
                                    <div class="info-item">
                                        <i class="fas fa-paw"></i>
                                        <div>
                                            <label>Nama Pet</label>
                                            <span>{{ $rekamMedis->temuDokter->pet->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-user-md"></i>
                                        <div>
                                            <label>Dokter Pemeriksa</label>
                                            <span>{{ $rekamMedis->dokter->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="medical-info">
                                    <div class="info-section">
                                        <label><i class="fas fa-notes-medical"></i> Diagnosa</label>
                                        <p>{{ Str::limit($rekamMedis->diagnosa, 150) ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('pemilik.rekam-medis.detail', $rekamMedis->idrekam_medis) }}" class="btn btn-view">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} RS Hewan UNAIR. All rights reserved.</p>
        </div>
    </footer>

@include('layouts.pemilik.scripts')
