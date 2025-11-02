<!DOCTYPE html>

<html lang="id">// Halaman temu dokter untuk resepsionis

<head>

    <meta charset="UTF-8">// Inisialisasi session dan validasi role

    <meta name="viewport" content="width=device-width, initial-scale=1.0">if (session_status() === PHP_SESSION_NONE) session_start();

    <title>Temu Dokter - Resepsionis RS Hewan UNAIR</title>

    // Import dependencies dan helper functions

    <!-- CSS Styling External -->require_once __DIR__ . '/../../logic/resepsionis/temu_dokter_process.php';

    <link rel="stylesheet" href="{{ asset('css/shared/style_data_master_new.css') }}">

    <link rel="stylesheet" href="{{ asset('css/resepsionis/style_temu_dokter.css') }}">// Validasi autentikasi dan role

    $role = strtolower(trim($_SESSION['user']['nama_role'] ?? ''));

    <!-- Font Google untuk typography yang konsisten -->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">// Redirect jika bukan resepsionis

</head>if ($role !== 'resepsionis') { 

<body>    header('Location: dashboard_resepsionis.php'); 

    exit; 

    <!-- MAIN CONTAINER-->}

    <div class="container-padded">

// Pengambilan data untuk halaman

        <!-- Header section: Title dan navigasi -->// Ambil semua data antrian temu dokter

        <div class="section-card">$list = get_all_temu_dokter();

            <h2 class="heading">Manajemen Antrian Temu Dokter</h2>

            <div class="toolbar">// Ambil data pet minimal untuk dropdown

                <!-- Tombol kembali ke dashboard resepsionis -->$pets = get_all_pet_minimal();

                <a class="btn" href="{{ route('resepsionis.dashboard') }}">

                    ← Kembali ke Dashboard// Ambil data dokter yang tersedia untuk dropdown

                </a>$dokter = get_all_dokter();

            </div>?>

        </div>

<!DOCTYPE html>

        <!-- Form pendaftaran antrian baru --><html lang="id">

        <div class="add-form"><head>

            <h3>Daftarkan Antrian Baru</h3>    <meta charset="UTF-8">

                <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <form method="POST" action="{{ route('resepsionis.temu-dokter.store') }}" class="row-form">    <title>Temu Dokter - Resepsionis RS Hewan UNAIR</title>

                @csrf    

                    <!-- CSS Styling External -->

                <!-- Dropdown untuk memilih pet -->    <link rel="stylesheet" href="../../css/shared/style_data_master_new.css">

                <div class="form-group inline">    <link rel="stylesheet" href="../../css/resepsionis/style_temu_dokter.css">

                    <label for="idpet">Pilih Pet:</label>    

                    <select name="idpet" id="idpet" required>    <!-- Font Google untuk typography yang konsisten -->

                        <option value="">-- Pilih Pet --</option>    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                        @forelse($pets as $pet)</head>

                            <option value="{{ $pet->idpet }}"><body>

                                {{ $pet->pemilik->user->nama ?? '-' }} - {{ $pet->nama }}

                            </option>    <!-- MAIN CONTAINER-->

                        @empty    <div class="container-padded">

                            <option value="" disabled>Tidak ada pet tersedia</option>

                        @endforelse        <!-- Header section: Title dan navigasi -->

                    </select>        <div class="section-card">

                    @error('idpet')            <h2 class="heading">Manajemen Antrian Temu Dokter</h2>

                        <span class="error-message">{{ $message }}</span>            <div class="toolbar">

                    @enderror                <!-- Tombol kembali ke dashboard resepsionis -->

                </div>                <a class="btn" href="./dashboard_resepsionis.php">

                                    ← Kembali ke Dashboard

                <!-- Dropdown untuk memilih dokter -->                </a>

                <div class="form-group inline">            </div>

                    <label for="idrole_user">Pilih Dokter:</label>        </div>

                    <select name="idrole_user" id="idrole_user" required>

                        <option value="">-- Pilih Dokter --</option>        <!-- Form pendaftaran antrian baru -->

                        @forelse($dokters as $dokter)        <div class="add-form">

                            <option value="{{ $dokter->idrole_user }}">            <h3>Daftarkan Antrian Baru</h3>

                                {{ $dokter->user->nama }}            

                            </option>            <form method="POST" action="../../logic/resepsionis/temu_dokter_process.php" class="row-form">

                        @empty                <!-- Hidden field untuk menentukan aksi yang akan dilakukan -->

                            <option value="" disabled>Tidak ada dokter tersedia</option>                <input type="hidden" name="aksi" value="tambah">

                        @endforelse                

                    </select>                <!-- Dropdown untuk memilih pet -->

                    @error('idrole_user')                <div class="form-group inline">

                        <span class="error-message">{{ $message }}</span>                    <label for="idpet">Pilih Pet:</label>

                    @enderror                    <select name="idpet" id="idpet" required>

                </div>                        <option value="">-- Pilih Pet --</option>

                                        <?php if ($pets && count($pets) > 0): ?>

                <!-- Tombol submit untuk mendaftarkan antrian -->                            <?php foreach ($pets as $p): ?>

                <button type="submit" class="btn primary">                                <option value="<?php echo (int)$p['idpet']; ?>">

                    + Daftarkan Antrian                                    <?php echo htmlspecialchars(($p['nama_pemilik'] ?? '') . ' - ' . ($p['nama_pet'] ?? '')); ?>

                </button>                                </option>

            </form>                            <?php endforeach; ?>

                                    <?php else: ?>

            <small class="form-help">                            <option value="" disabled>Tidak ada pet tersedia</option>

                Catatan: Pilih pet dan dokter untuk mendaftarkan antrian temu dokter baru                        <?php endif; ?>

            </small>                    </select>

        </div>                </div>

                

        <!-- Daftar antrian temu dokter -->                <!-- Dropdown untuk memilih dokter -->

        <div class="table-wrapper">                <div class="form-group inline">

            <h3>Daftar Antrian Hari Ini</h3>                    <label for="idrole_user">Pilih Dokter:</label>

                                <select name="idrole_user" id="idrole_user" required>

            <table class="table-clean">                        <option value="">-- Pilih Dokter --</option>

                <!-- Header tabel dengan kolom yang jelas -->                        <?php if ($dokter && count($dokter) > 0): ?>

                <thead>                            <?php foreach ($dokter as $d): ?>

                    <tr>                                <option value="<?php echo (int)$d['idrole_user']; ?>">

                        <th>No Antrian</th>                                    <?php echo htmlspecialchars($d['nama']); ?>

                        <th>Waktu Daftar</th>                                </option>

                        <th>Pet</th>                            <?php endforeach; ?>

                        <th>Pemilik</th>                        <?php else: ?>

                        <th>Dokter</th>                            <option value="" disabled>Tidak ada dokter tersedia</option>

                        <th>Status</th>                        <?php endif; ?>

                    </tr>                    </select>

                </thead>                </div>

                                

                <!-- Body tabel dengan data antrian -->                <!-- Tombol submit untuk mendaftarkan antrian -->

                <tbody>                <button type="submit" class="btn primary">

                    @if($temuDokterList->isEmpty())                    + Daftarkan Antrian

                        <!-- Jika tidak ada data, tampilkan pesan kosong -->                </button>

                        <tr class="empty-row">            </form>

                            <td colspan="6" class="text-center">            

                                <em>Belum ada antrian terdaftar untuk hari ini</em>            <small class="form-help">

                            </td>                Catatan: Pilih pet dan dokter untuk mendaftarkan antrian temu dokter baru

                        </tr>            </small>

                    @else        </div>

                        <!-- Loop untuk setiap data antrian -->

                        @foreach($temuDokterList as $temu)        <!-- Daftar antrian temu dokter -->

                            <tr>        <div class="table-wrapper">

                                <!-- No antrian dengan format yang konsisten -->            <h3>Daftar Antrian Hari Ini</h3>

                                <td class="text-center">            

                                    <strong>{{ $temu->no_urut }}</strong>            <table class="table-clean">

                                </td>                <!-- Header tabel dengan kolom yang jelas -->

                                                <thead>

                                <!-- Waktu daftar dengan Carbon formatting -->                    <tr>

                                <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d/m/Y H:i') }}</td>                        <th>No Antrian</th>

                                                        <th>Waktu Daftar</th>

                                <!-- Nama pet dengan null safety -->                        <th>Pet</th>

                                <td>{{ $temu->pet->nama ?? '-' }}</td>                        <th>Pemilik</th>

                                                        <th>Dokter</th>

                                <!-- Nama pemilik dengan null safety -->                        <th>Status</th>

                                <td>{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>                    </tr>

                                                </thead>

                                <!-- Nama dokter dengan null safety -->                

                                <td>{{ $temu->roleUser->user->nama ?? '-' }}</td>                <!-- Body tabel dengan data antrian -->

                                                <tbody>

                                <!-- Status dengan styling yang sesuai -->                    <?php if (empty($list)): ?>

                                <td>                        <!-- Jika tidak ada data, tampilkan pesan kosong -->

                                    @switch($temu->status)                        <tr class="empty-row">

                                        @case('A')                            <td colspan="6" class="text-center">

                                            <span class="status status-a">Menunggu</span>                                <em>Belum ada antrian terdaftar untuk hari ini</em>

                                            @break                            </td>

                                        @case('D')                        </tr>

                                            <span class="status status-d">Dalam Pemeriksaan</span>                    <?php else: ?>

                                            @break                        <!-- Loop untuk setiap data antrian -->

                                        @case('S')                        <?php foreach ($list as $row): ?>

                                            <span class="status status-s">Selesai</span>                            <tr>

                                            @break                                <!-- No antrian dengan format yang konsisten -->

                                        @default                                <td class="text-center">

                                            <span class="status status-unknown">{{ $temu->status }}</span>                                    <strong><?php echo (int)$row['no_urut']; ?></strong>

                                    @endswitch                                </td>

                                </td>                                

                            </tr>                                <!-- Waktu daftar dengan sanitasi -->

                        @endforeach                                <td><?php echo htmlspecialchars($row['waktu_daftar']); ?></td>

                    @endif                                

                </tbody>                                <!-- Nama pet dengan null safety -->

            </table>                                <td><?php echo htmlspecialchars($row['nama_pet'] ?? '-'); ?></td>

        </div>                                

    </div>                                <!-- Nama pemilik dengan null safety -->

                                <td><?php echo htmlspecialchars($row['nama_pemilik'] ?? '-'); ?></td>

</body>                                

</html>                                <!-- Nama dokter dengan null safety -->

                                <td><?php echo htmlspecialchars($row['nama_dokter'] ?? '-'); ?></td>
                                
                                <!-- Status dengan styling yang sesuai -->
                                <td>
                                    <span class="status status-<?php echo strtolower($row['status'] ?? 'unknown'); ?>">
                                        <?php 
                                        // Format status untuk display yang user-friendly
                                        $status = $row['status'] ?? '';
                                        switch($status) {
                                            case 'A': echo 'Menunggu'; break;
                                            case 'D': echo 'Dalam Pemeriksaan'; break;
                                            case 'S': echo 'Selesai'; break;
                                            default: echo htmlspecialchars($status);
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
