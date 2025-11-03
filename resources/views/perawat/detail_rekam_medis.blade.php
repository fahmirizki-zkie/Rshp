<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rekam Medis - Perawat RS Hewan UNAIR</title>
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
            <a href="{{ route('perawat.rekam-medis') }}">Back</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Detail Rekam Medis</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

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
                                {{ $kode->kode }} - {{ $kode->nama_tindakan }}
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
                                <td>{{ $detail->kodeTindakanTerapi->nama_tindakan ?? '-' }}</td>
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
</body>
</html>
