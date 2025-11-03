<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temu Dokter - Resepsionis RS Hewan UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}">
    <link rel="stylesheet" href="{{ asset('css/resepsionis/style_temu_dokter.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- MAIN CONTAINER-->
    <div class="container-padded">
        
        <!-- Header section: Title dan navigasi -->
        <div class="section-card">
            <h2 class="heading">Manajemen Antrian Temu Dokter</h2>
            <div class="toolbar">
                <!-- Tombol kembali ke dashboard resepsionis -->
                <a class="btn" href="{{ route('resepsionis.dashboard') }}">
                     Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Notifikasi Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- Form pendaftaran antrian baru -->
        <div class="add-form">
            <h3>Daftarkan Antrian Baru</h3>
            
            <form method="POST" action="{{ route('resepsionis.temu-dokter') }}" class="row-form">
                @csrf
                
                <!-- Dropdown untuk memilih pet -->
                <div class="form-group inline">
                    <label for="idpet">Pilih Pet:</label>
                    <select name="idpet" id="idpet" required>
                        <option value="">-- Pilih Pet --</option>
                        @forelse($pets as $pet)
                            <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                                {{ $pet->pemilik->user->nama ?? '-' }} - {{ $pet->nama }}
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada pet tersedia</option>
                        @endforelse
                    </select>
                    @error('idpet')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dropdown untuk memilih dokter -->
                <div class="form-group inline">
                    <label for="idrole_user">Pilih Dokter:</label>
                    <select name="idrole_user" id="idrole_user" required>
                        <option value="">-- Pilih Dokter --</option>
                        @forelse($dokters as $dokter)
                            <option value="{{ $dokter->idrole_user }}" {{ old('idrole_user') == $dokter->idrole_user ? 'selected' : '' }}>
                                {{ $dokter->user->nama }}
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada dokter tersedia</option>
                        @endforelse
                    </select>
                    @error('idrole_user')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol submit untuk mendaftarkan antrian -->
                <button type="submit" class="btn primary">
                    + Daftarkan Antrian
                </button>
            </form>

            <small class="form-help">
                Catatan: Pilih pet dan dokter untuk mendaftarkan antrian temu dokter baru
            </small>
        </div>

        <!-- Daftar antrian temu dokter -->
        <div class="table-wrapper">
            <h3>Daftar Antrian Hari Ini</h3>
            
            <table class="table-clean">
                <!-- Header tabel dengan kolom yang jelas -->
                <thead>
                    <tr>
                        <th>No Antrian</th>
                        <th>Waktu Daftar</th>
                        <th>Pet</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <!-- Body tabel dengan data antrian -->
                <tbody>
                    @if($temuDokterList->isEmpty())
                        <!-- Jika tidak ada data, tampilkan pesan kosong -->
                        <tr class="empty-row">
                            <td colspan="6" class="text-center">
                                <em>Belum ada antrian terdaftar untuk hari ini</em>
                            </td>
                        </tr>
                    @else
                        <!-- Loop untuk setiap data antrian -->
                        @foreach($temuDokterList as $temu)
                            <tr>
                                <!-- No antrian dengan format yang konsisten -->
                                <td class="text-center">
                                    <strong>{{ $temu->no_urut }}</strong>
                                </td>

                                <!-- Waktu daftar dengan Carbon formatting -->
                                <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d/m/Y H:i') }}</td>

                                <!-- Nama pet dengan null safety -->
                                <td>{{ $temu->pet->nama ?? '-' }}</td>

                                <!-- Nama pemilik dengan null safety -->
                                <td>{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>

                                <!-- Nama dokter dengan null safety -->
                                <td>{{ $temu->roleUser->user->nama ?? '-' }}</td>

                                <!-- Status dengan styling yang sesuai -->
                                <td>
                                    @switch($temu->status)
                                        @case('A')
                                            <span class="status status-a">Menunggu</span>
                                            @break
                                        @case('D')
                                            <span class="status status-d">Dalam Pemeriksaan</span>
                                            @break
                                        @case('S')
                                            <span class="status status-s">Selesai</span>
                                            @break
                                        @default
                                            <span class="status status-unknown">{{ $temu->status }}</span>
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
