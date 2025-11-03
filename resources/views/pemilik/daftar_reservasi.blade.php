<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Reservasi - RS Hewan UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/pemilik/style_daftar_reservasi.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('img/medical.avif') }}" alt="RS Hewan UNAIR">
                <span>RS Hewan UNAIR</span>
            </div>
            
            <nav class="nav-menu">
                <a href="{{ route('pemilik.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ route('pemilik.daftar-pet') }}"><i class="fas fa-paw"></i> Daftar Pet</a>
                <a href="{{ route('pemilik.reservasi') }}" class="active"><i class="fas fa-calendar"></i> Reservasi</a>
                <a href="{{ route('pemilik.rekam-medis') }}"><i class="fas fa-file-medical"></i> Rekam Medis</a>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1><i class="fas fa-calendar"></i> Daftar Reservasi</h1>
                <p>Riwayat jadwal konsultasi dan pemeriksaan</p>
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

            @if($reservations->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Belum Ada Reservasi</h3>
                    <p>Anda belum memiliki jadwal reservasi konsultasi</p>
                </div>
            @else
                <div class="reservations-list">
                    @foreach($reservations as $reservation)
                        <div class="reservation-card">
                            <div class="card-header">
                                <div class="reservation-number">
                                    <i class="fas fa-hashtag"></i>
                                    <span>No. Urut: {{ $reservation->no_urut }}</span>
                                </div>
                                <div class="reservation-status status-{{ strtolower($reservation->status) }}">
                                    {{ $reservation->status }}
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="info-row">
                                    <div class="info-item">
                                        <i class="fas fa-paw"></i>
                                        <div>
                                            <label>Nama Pet</label>
                                            <span>{{ $reservation->pet->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-user-md"></i>
                                        <div>
                                            <label>Dokter</label>
                                            <span>{{ $reservation->roleUser->user->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-item">
                                        <i class="fas fa-calendar-day"></i>
                                        <div>
                                            <label>Waktu Daftar</label>
                                            <span>{{ \Carbon\Carbon::parse($reservation->waktu_daftar)->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                @if(strtolower($reservation->status) === 'selesai')
                                    <a href="{{ route('pemilik.rekam-medis.detail', $reservation->idreservasi_dokter) }}" class="btn btn-view">
                                        <i class="fas fa-eye"></i> Lihat Rekam Medis
                                    </a>
                                @endif
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
</body>
</html>
