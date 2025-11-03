<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis - Dokter RSHP UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/dokter/style_rekam_medis.css') }}">
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
            <a href="{{ route('dokter.dashboard') }}">Back</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Rekam Medis Pasien</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="section">
            <h2>Daftar Rekam Medis</h2>

            @if($dataRekamMedis->isEmpty())
                <p class="no-data">Belum ada data rekam medis.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Rekam Medis</th>
                            <th>Tanggal</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataRekamMedis as $index => $rekam)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rekam->idrekam_medis }}</td>
                                <td>{{ \Carbon\Carbon::parse($rekam->tanggal_rekam_medis)->format('d/m/Y') }}</td>
                                <td>{{ $rekam->temuDokter->pet->nama ?? '-' }}</td>
                                <td>{{ $rekam->temuDokter->pet->pemilik->user->nama ?? '-' }}</td>
                                <td>{{ Str::limit($rekam->diagnosa, 50) ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('dokter.detail-rekam-medis', $rekam->idrekam_medis) }}" class="btn-view">Lihat Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
