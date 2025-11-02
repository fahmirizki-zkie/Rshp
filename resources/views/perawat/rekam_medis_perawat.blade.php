<!DOCTYPE html><?php

<html lang="id">// Mulai session untuk tracking user login

<head>session_start();

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// Validasi autentikasi user

    <title>Rekam Medis - Perawat RS Hewan UNAIR</title>// Redirect ke login jika belum terautentikasi

    if (!isset($_SESSION['user'])) {

    <!-- CSS Styling External -->    header('Location: login.php');

    <link rel="stylesheet" href="{{ asset('css/st.css') }}">    exit;

    }

    <!-- Font Google untuk typography yang konsisten -->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">// SECTION 2: IMPORT CLASS DAN INISIALISASI OBJEK

</head>

<body>// Import class-class yang dibutuhkan untuk operasi rekam medis

    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->require_once __DIR__ . '/../../class/RekamMedis.php';

    <div class="nav-content">require_once __DIR__ . '/../../class/TemuDokter.php';

        <div class="logokiri">

            <img src="{{ asset('img/unair.avif') }}" alt="Logo UNAIR">// Inisialisasi objek untuk operasi database

        </div>// Menggunakan class-based approach untuk maintainability

        <div class="text">$rekamMedis = new RekamMedis();

            <h2>Universitas Airlangga |</h2>$temuDokter = new TemuDokter();

        </div>

        <div class="text2">// SECTION 3: PENGAMBILAN DATA REKAM MEDIS YANG SUDAH ADA

            <h2>Rumah Sakit Hewan Pendidikan</h2>

        </div>// Ambil semua data rekam medis dengan JOIN table terkait

        <div class="logokanan">// Data sudah lengkap dengan informasi pet, pemilik, dan dokter

            <img src="{{ asset('img/medical.avif') }}" alt="Logo RSHP">$dataRekamMedis = $rekamMedis->getAllJoined();

        </div>

    </div>// SECTION 4: PENGAMBILAN DATA TEMU DOKTER TANPA REKAM MEDIS



    <!-- NAVIGATION BAR -->// Ambil data temu dokter yang belum memiliki rekam medis

    <div class="navbar">$temuTanpaRekam = $temuDokter->getTemuDokterTanpaRekamMedis();

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

        <div class="navbar-nav">// SECTION 5: PENGAMBILAN DAN SANITASI DATA USER

            <a href="{{ route('perawat.dashboard') }}">Back</a>

            <a href="{{ route('logout') }}">Logout</a>// Ambil data user dari session dan sanitasi untuk keamanan

        </div>$user = $_SESSION['user'];

    </div>$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

?>

    <!-- MAIN CONTENT -->

    <div class="container"><!DOCTYPE html>

        <h1>Kelola Rekam Medis</h1><html lang="id">

        <head>

        <!-- MESSAGES -->    <meta charset="UTF-8">

        @if(session('success'))    <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <div class="alert alert-success">    <title>Rekam Medis - Perawat RS Hewan UNAIR</title>

                {{ session('success') }}    

            </div>    <!-- CSS Styling External -->

        @endif    <link rel="stylesheet" href="../../css/shared/style_rekam_medis.css">

            

        @if(session('error'))    <!-- Font Google untuk typography yang konsisten -->

            <div class="alert alert-danger">    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                {{ session('error') }}</head>

            </div><body>

        @endif    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->

            <div class="nav-content">

        <!-- TEMU DOKTER TANPA REKAM MEDIS -->        <!-- Logo Universitas Airlangga (kiri) -->

        @if($temuTanpaRekam->isNotEmpty())        <div class="logokiri">

        <div class="section">            <img src="../../img/unairr.png" alt="Logo UNAIR">

            <h2>🆕 Temu Dokter Belum Ada Rekam Medis</h2>        </div>

            <div class="table-container">        

                <table>        <!-- Text header utama -->

                    <thead>        <div class="text">

                        <tr>            <h2>Universitas Airlangga |</h2>

                            <th>No. Urut</th>        </div>

                            <th>Tanggal/Waktu</th>        

                            <th>Pet</th>        <!-- Text header secondary -->

                            <th>Pemilik</th>        <div class="text2">

                            <th>Dokter</th>            <h2>Rumah Sakit Hewan Pendidikan</h2>

                            <th>Status</th>        </div>

                            <th>Aksi</th>        

                        </tr>        <!-- Logo Rumah Sakit Hewan (kanan) -->

                    </thead>        <div class="logokanan">

                    <tbody>            <img src="../../img/rshpp.png" alt="Logo RSHP">

                        @foreach($temuTanpaRekam as $temu)        </div>

                        <tr>    </div>

                            <td>{{ $temu->no_urut }}</td>

                            <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d/m/Y H:i') }}</td>    <!-- =================================================================== -->

                            <td>{{ $temu->pet->nama ?? '-' }}</td>    <!-- NAVIGATION BAR: Menu navigasi dan logout -->

                            <td>{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>    <!-- =================================================================== -->

                            <td>{{ $temu->roleUser->user->nama ?? '-' }}</td>    <div class="navbar">

                            <td>        <!-- Brand logo/text -->

                                <span class="status {{ strtolower($temu->status) }}">        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

                                    @switch($temu->status)        

                                        @case('A') Antri @break        <!-- Navigation menu -->

                                        @case('D') Dipanggil @break        <div class="navbar-nav">

                                        @case('S') Selesai @break            <a href="dashboard_perawat.php">Back</a>

                                    @endswitch            <a href="../../logic/login.php?action=logout">Logout</a>

                                </span>        </div>

                            </td>    </div>

                            <td>

                                <a href="{{ route('perawat.tambah-rekam-medis', ['idreservasi' => $temu->idreservasi_dokter]) }}"     <!-- MAIN CONTENT: Container untuk semua konten halaman -->

                                   class="btn btn-primary">Buat Rekam Medis</a>    <div class="container">

                            </td>        <h1>Kelola Rekam Medis</h1>

                        </tr>        

                        @endforeach    

                    </tbody>        <!-- MESSAGE SECTION: Alert untuk success/error messages -->

                </table>        <!-- Message success -->

            </div>        <?php if (isset($_GET['success'])): ?>

        </div>            <div class="alert alert-success">

        @endif                <?php

                if ($_GET['success'] == 'deleted') {

        <!-- DAFTAR REKAM MEDIS -->                    echo 'Rekam medis berhasil dihapus.';

        <div class="section">                } elseif ($_GET['success'] == 'created') {

            <h2>📋 Daftar Rekam Medis</h2>                    echo 'Rekam medis berhasil dibuat.';

            @if($dataRekamMedis->isNotEmpty())                } elseif ($_GET['success'] == 'updated') {

            <div class="table-container">                    echo 'Rekam medis berhasil diupdate.';

                <table>                } else {

                    <thead>                    echo 'Operasi berhasil dilakukan.';

                        <tr>                }

                            <th>ID</th>                ?>

                            <th>Tanggal</th>            </div>

                            <th>Pet</th>        <?php endif; ?>

                            <th>Pemilik</th>        

                            <th>Dokter</th>        <!-- Message error -->

                            <th>Diagnosa</th>        <?php if (isset($_GET['error'])): ?>

                            <th>Aksi</th>            <div class="alert alert-danger">

                        </tr>                <?php echo 'Error: ' . htmlspecialchars($_GET['error']); ?>

                    </thead>            </div>

                    <tbody>        <?php endif; ?>

                        @foreach($dataRekamMedis as $rekam)        

                        <tr>        <!-- =================================================================== -->

                            <td>{{ $rekam->idrekam_medis }}</td>        <!-- SECTION 1: Temu Dokter Tanpa Rekam Medis -->

                            <td>{{ \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y H:i') }}</td>        <!-- =================================================================== -->

                            <td>{{ $rekam->temuDokter->pet->nama ?? '-' }}</td>        <?php 

                            <td>{{ $rekam->temuDokter->pet->pemilik->user->nama ?? '-' }}</td>        /**

                            <td>{{ $rekam->dokter->nama ?? '-' }}</td>         * Tampilkan tabel temu dokter yang belum memiliki rekam medis

                            <td>{{ $rekam->diagnosa ? Str::limit($rekam->diagnosa, 50) : '-' }}</td>         * Section ini prioritas untuk membuat rekam medis baru

                            <td>         */

                                <a href="{{ route('perawat.detail-rekam-medis', $rekam->idrekam_medis) }}"         if (!empty($temuTanpaRekam['data'])): 

                                   class="btn btn-info">Detail</a>        ?>

                                        <div class="section">

                                <a href="{{ route('perawat.edit-rekam-medis', $rekam->idrekam_medis) }}"             <h2>🆕 Temu Dokter Belum Ada Rekam Medis</h2>

                                   class="btn btn-warning">Edit</a>            <div class="table-container">

                                                <table>

                                <form action="{{ route('perawat.delete-rekam-medis', $rekam->idrekam_medis) }}"                     <thead>

                                      method="POST" style="display:inline;">                        <tr>

                                    @csrf                            <th>No. Urut</th>

                                    @method('DELETE')                            <th>Tanggal/Waktu</th>

                                    <button type="submit" class="btn btn-danger"                             <th>Pet</th>

                                            onclick="return confirm('Yakin ingin menghapus?')">                            <th>Pemilik</th>

                                        Hapus                            <th>Dokter</th>

                                    </button>                            <th>Status</th>

                                </form>                            <th>Aksi</th>

                            </td>                        </tr>

                        </tr>                    </thead>

                        @endforeach                    <tbody>

                    </tbody>                        <?php 

                </table>                        // Loop untuk menampilkan setiap temu dokter tanpa rekam medis

            </div>                        // Data sudah ter-join dari query kompleks di atas

            @else                        foreach ($temuTanpaRekam['data'] as $temu): 

            <div class="no-data">                        ?>

                <p>Belum ada rekam medis.</p>                        <tr>

            </div>                            <!-- Nomor urut antrian -->

            @endif                            <td><?php echo htmlspecialchars($temu['no_urut']); ?></td>

        </div>                            

    </div>                            <!-- Tanggal dan waktu dengan format Indonesia -->

</body>                            <td><?php echo date('d/m/Y H:i', strtotime($temu['waktu_daftar'])); ?></td>

</html>                            

                            <!-- Nama pet dengan fallback jika null -->
                            <td><?php echo htmlspecialchars($temu['nama_pet'] ?? '-'); ?></td>
                            
                            <!-- Nama pemilik dengan sanitasi -->
                            <td><?php echo htmlspecialchars($temu['nama_pemilik'] ?? '-'); ?></td>
                            
                            <!-- Nama dokter yang menangani -->
                            <td><?php echo htmlspecialchars($temu['nama_dokter'] ?? '-'); ?></td>
                            
                            <!-- Status dengan color coding -->
                            <td>
                                <span class="status <?php echo strtolower($temu['status']); ?>">
                                    <?php
                                    // Konversi kode status ke teks yang user-friendly
                                    // A = Antri, D = Dipanggil, S = Selesai
                                    switch($temu['status']) {
                                        case 'A': echo 'Antri'; break;
                                        case 'D': echo 'Dipanggil'; break;
                                        case 'S': echo 'Selesai'; break;
                                    }
                                    ?>
                                </span>
                            </td>
                            
                            <!-- Action button untuk membuat rekam medis -->
                            <td>
                                <a href="tambah_rekam_medis.php?reservasi=<?php echo $temu['idreservasi_dokter']; ?>" 
                                   class="btn btn-primary">Buat Rekam Medis</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <!-- SECTION 2: Daftar Rekam Medis Yang Sudah Ada -->
        <div class="section">
            <h2>📋 Daftar Rekam Medis</h2>
            <?php 
            // Conditional rendering berdasarkan ada tidaknya data rekam medis
            // Jika ada data, tampilkan tabel, jika tidak tampilkan pesan kosong
            if (!empty($dataRekamMedis)): 
            ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Pet</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Loop untuk menampilkan setiap rekam medis yang sudah ada
                        // Data sudah lengkap dari method getAllJoined()
                        foreach ($dataRekamMedis as $rekam): 
                        ?>
                        <tr>
                            <!-- ID rekam medis -->
                            <td><?php echo $rekam['idrekam_medis']; ?></td>
                            
                            <!-- Tanggal pembuatan dengan format Indonesia -->
                            <td><?php echo date('d/m/Y H:i', strtotime($rekam['created_at'])); ?></td>
                            
                            <!-- Nama pet dengan sanitasi -->
                            <td><?php echo htmlspecialchars($rekam['nama_pet'] ?? '-'); ?></td>
                            
                            <!-- Nama pemilik -->
                            <td><?php echo htmlspecialchars($rekam['nama_pemilik'] ?? '-'); ?></td>
                            
                            <!-- Nama dokter yang memeriksa -->
                            <td><?php echo htmlspecialchars($rekam['nama_dokter'] ?? '-'); ?></td>
                            
                            <!-- Diagnosa dengan truncation untuk table display -->
                            <td>
                                <?php 
                                // Potong diagnosa menjadi 50 karakter untuk tampilan tabel
                                // Jika lebih panjang, tambahkan ... sebagai indicator
                                echo htmlspecialchars($rekam['diagnosa'] ? substr($rekam['diagnosa'], 0, 50) . '...' : '-'); 
                                ?>
                            </td>
                            
                            <!-- Action buttons untuk CRUD operations -->
                            <td>
                                <!-- Button Detail: untuk melihat rekam medis lengkap -->
                                <a href="detail_rekam_medis.php?id=<?php echo $rekam['idrekam_medis']; ?>" 
                                   class="btn btn-info">Detail</a>
                                
                                <!-- Button Edit: untuk mengubah rekam medis -->
                                <a href="edit_rekam_medis.php?id=<?php echo $rekam['idrekam_medis']; ?>" 
                                   class="btn btn-warning">Edit</a>
                                
                                <!-- Button Hapus: tanpa konfirmasi JavaScript -->
                                <a href="../../logic/perawat/rekam_medis_process.php?action=delete&id=<?php echo $rekam['idrekam_medis']; ?>" 
                                   class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <!-- Empty state ketika belum ada rekam medis -->
            <div class="no-data">
                <p>Belum ada rekam medis.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>