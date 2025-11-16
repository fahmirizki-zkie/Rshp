@include('layouts.dokter.head')

<link rel="stylesheet" href="{{ asset('css/dokter/style_rekam_medis.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

@include('layouts.dokter.header')
@include('layouts.dokter.navbar')

<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="container">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
        <h1 style="margin: 0;">Detail Rekam Medis</h1>
        <a href="{{ route('dokter.rekam-medis') }}" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
            <span>←</span> Kembali
        </a>
    </div>

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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</div>

@include('layouts.dokter.footer')
@include('layouts.dokter.scripts')
