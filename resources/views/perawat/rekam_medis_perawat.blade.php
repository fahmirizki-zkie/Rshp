@include('layouts.perawat.head')

<link rel="stylesheet" href="{{ asset('css/dokter/style_rekam_medis.css') }}">

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
    <h1>Kelola Rekam Medis</h1>

    <div class="section">
        <h2>Temu Dokter Belum Ada Rekam Medis</h2>
        @if($temuTanpaRekam->isEmpty())
            <p class="no-data">Semua temu dokter sudah memiliki rekam medis.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No. Urut</th>
                        <th>Waktu Daftar</th>
                        <th>Pet</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($temuTanpaRekam as $temu)
                        <tr>
                            <td>{{ $temu->no_urut }}</td>
                            <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d/m/Y H:i') }}</td>
                            <td>{{ $temu->pet->nama ?? '-' }}</td>
                            <td>{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>
                            <td>{{ $temu->roleUser->user->nama ?? '-' }}</td>
                            <td>
                                <a href="{{ route('perawat.tambah-rekam-medis', $temu->idreservasi_dokter) }}" class="btn-add">Tambah Rekam Medis</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="section">
        <h2>Daftar Rekam Medis</h2>
        @if($dataRekamMedis->isEmpty())
            <p class="no-data">Belum ada rekam medis.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>Tanggal</th>
                        <th>Pet</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataRekamMedis as $rekam)
                        <tr>
                            <td>{{ $rekam->idrekam_medis }}</td>
                            <td>{{ \Carbon\Carbon::parse($rekam->tanggal_rekam_medis)->format('d/m/Y') }}</td>
                            <td>{{ $rekam->temuDokter->pet->nama ?? '-' }}</td>
                            <td>{{ $rekam->temuDokter->pet->pemilik->user->nama ?? '-' }}</td>
                            <td>{{ $rekam->dokter->nama ?? '-' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($rekam->diagnosa, 50) }}</td>
                            <td>
                                <a href="{{ route('perawat.detail-rekam-medis', $rekam->idrekam_medis) }}" class="btn-detail">Detail</a>
                                <a href="{{ route('perawat.edit-rekam-medis', $rekam->idrekam_medis) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('perawat.rekam-medis.delete', $rekam->idrekam_medis) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus rekam medis ini?');">
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
