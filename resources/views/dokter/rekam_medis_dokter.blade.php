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
    <h1>Rekam Medis Pasien</h1>

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
</div>

@include('layouts.dokter.footer')
@include('layouts.dokter.scripts')
