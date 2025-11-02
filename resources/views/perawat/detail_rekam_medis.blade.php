<!DOCTYPE html><?php

<html lang="id">

<head>// SECTION 1: INISIALISASI SESSION DAN VALIDASI AUTENTIKASI

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// Mulai session untuk tracking user login

    <title>Detail Rekam Medis - Perawat RS Hewan UNAIR</title>session_start();

    

    <!-- CSS Styling External -->// Validasi autentikasi user

    <link rel="stylesheet" href="{{ asset('css/shared/style_rekam_medis.css') }}">// Redirect ke login jika belum terautentikasi

    if (!isset($_SESSION['user'])) {

    <!-- Font Google untuk typography yang konsisten -->    header('Location: login.php');

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">    exit;

</head>}

<body>

    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->// SECTION 2: IMPORT CLASS DAN INISIALISASI

    <div class="nav-content">

        <!-- Logo Universitas Airlangga (kiri) -->// Import class-class yang dibutuhkan untuk operasi detail rekam medis

        <div class="logokiri">require_once __DIR__ . '/../../class/RekamMedis.php';

            <img src="{{ asset('img/unairr.png') }}" alt="Logo UNAIR">require_once __DIR__ . '/../../class/DetailRekamMedis.php';

        </div>require_once __DIR__ . '/../../class/KodeTindakanTerapi.php';

        

        <!-- Text header utama -->// Ambil data user dari session dengan sanitasi

        <div class="text">$user = $_SESSION['user'];

            <h2>Universitas Airlangga |</h2>$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

        </div>

        // SECTION 3: VALIDASI DAN PENGAMBILAN ID REKAM MEDIS

        <!-- Text header secondary -->

        <div class="text2">// Ambil ID rekam medis dari parameter URL

            <h2>Rumah Sakit Hewan Pendidikan</h2>// Validasi dan convert ke integer untuk keamanan

        </div>$rekam_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        

        <!-- Logo Rumah Sakit Hewan (kanan) -->// Validasi ID rekam medis tidak boleh 0 atau kosong

        <div class="logokanan">// Redirect ke halaman utama jika invalid

            <img src="{{ asset('img/rshpp.png') }}" alt="Logo RSHP">if ($rekam_id == 0) {

        </div>    header('Location: rekam_medis_perawat.php?error=invalid_id');

    </div>    exit;

}

    <!-- NAVIGATION BAR: Menu navigasi dan logout -->

    <div class="navbar">// SECTION 4: PENGAMBILAN DATA REKAM MEDIS

        <!-- Brand logo/text -->

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>// Inisialisasi object RekamMedis dan ambil data berdasarkan ID

        $rekamMedis = new RekamMedis();

        <!-- Navigation menu -->$rekamData = $rekamMedis->getById($rekam_id);

        <div class="navbar-nav">

            <a href="{{ route('perawat.rekam-medis') }}">Back</a>// Validasi keberadaan data rekam medis

            <a href="{{ route('logout') }}">Logout</a>// Redirect jika data tidak ditemukan

        </div>if (!$rekamData) {

    </div>    header('Location: rekam_medis_perawat.php?error=record_not_found');

    exit;

    <!-- MAIN CONTENT: Container untuk semua konten halaman -->}

    <div class="container">

        <h1>Detail Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h1>// SECTION 5: PENGAMBILAN DATA TINDAKAN TERAPI

        

        <!-- SECTION 1: Informasi Rekam Medis Utama -->// Ambil semua detail tindakan terapi untuk rekam medis ini

        <div class="info-card">$detailRekamMedis = new DetailRekamMedis();

            <h3>Informasi Rekam Medis</h3>$detailData = $detailRekamMedis->getByRekamMedis($rekam_id);

            

            <!-- Grid informasi umum rekam medis -->// Ambil semua kode tindakan terapi yang tersedia untuk form

            <div class="info-grid">// Data sudah ter-join dengan kategori dan kategori klinis

                <!-- Tanggal pembuatan rekam medis -->$kodeTindakanTerapiObj = new KodeTindakanTerapi();

                <div class="info-item">$kodeTindakanTerapi = $kodeTindakanTerapiObj->getAllJoined();

                    <strong>Tanggal Dibuat:</strong> ?>

                    {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d/m/Y H:i') }}

                </div><!DOCTYPE html>

                <html lang="id">

                <!-- Nomor urut temu dokter --><head>

                <div class="info-item">    <meta charset="UTF-8">

                    <strong>No. Urut Temu:</strong>     <meta name="viewport" content="width=device-width, initial-scale=1.0">

                    {{ $rekamMedis->temuDokter->no_urut ?? '-' }}    <title>Detail Rekam Medis - Perawat RS Hewan UNAIR</title>

                </div>    

                    <!-- CSS Styling External -->

                <!-- Nama hewan peliharaan -->    <link rel="stylesheet" href="../../css/shared/style_rekam_medis.css">

                <div class="info-item">    

                    <strong>Nama Pet:</strong>     <!-- Font Google untuk typography yang konsisten -->

                    {{ $rekamMedis->temuDokter->pet->nama ?? '-' }}    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                </div></head>

                <body>

                <!-- Nama pemilik hewan -->    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->

                <div class="info-item">    <div class="nav-content">

                    <strong>Pemilik:</strong>         <!-- Logo Universitas Airlangga (kiri) -->

                    {{ $rekamMedis->temuDokter->pet->pemilik->user->nama ?? '-' }}        <div class="logokiri">

                </div>            <img src="../../img/unairr.png" alt="Logo UNAIR">

                        </div>

                <!-- Nama dokter pemeriksa -->        

                <div class="info-item">        <!-- Text header utama -->

                    <strong>Dokter Pemeriksa:</strong>         <div class="text">

                    {{ $rekamMedis->dokter->nama ?? '-' }}            <h2>Universitas Airlangga |</h2>

                </div>        </div>

            </div>        

                    <!-- Text header secondary -->

            <!-- Detail medis lengkap -->        <div class="text2">

            <div class="medical-details">            <h2>Rumah Sakit Hewan Pendidikan</h2>

                <!-- Anamnesa: riwayat yang diceritakan pemilik -->        </div>

                <div class="detail-section">        

                    <h4>Anamnesa:</h4>        <!-- Logo Rumah Sakit Hewan (kanan) -->

                    <p>{!! nl2br(e($rekamMedis->anamnesa ?? '-')) !!}</p>        <div class="logokanan">

                </div>            <img src="../../img/rshpp.png" alt="Logo RSHP">

                        </div>

                <!-- Temuan klinis: hasil pemeriksaan fisik -->    </div>

                <div class="detail-section">

                    <h4>Temuan Klinis:</h4>    <!-- NAVIGATION BAR: Menu navigasi dan logout -->

                    <p>{!! nl2br(e($rekamMedis->temuan_klinis ?? '-')) !!}</p>    <div class="navbar">

                </div>        <!-- Brand logo/text -->

                        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

                <!-- Diagnosa: kesimpulan dokter -->        

                <div class="detail-section">        <!-- Navigation menu -->

                    <h4>Diagnosa:</h4>        <div class="navbar-nav">

                    <p>{!! nl2br(e($rekamMedis->diagnosa ?? '-')) !!}</p>            <a href="rekam_medis_perawat.php">Back</a>

                </div>            <a href="../../logic/login.php?action=logout">Logout</a>

            </div>        </div>

                </div>

            <!-- Action buttons untuk operasi rekam medis -->

            <div class="actions">    <!-- MAIN CONTENT: Container untuk semua konten halaman -->

                <!-- Form untuk hapus rekam medis dengan konfirmasi ketat -->    <div class="container">

                <form action="{{ route('perawat.rekam-medis.delete', $rekamMedis->idrekam_medis) }}"         <h1>Detail Rekam Medis #<?php echo $rekam_id; ?></h1>

                      method="POST"         

                      style="display: inline;"        <!-- SECTION 1: Informasi Rekam Medis Utama -->

                      onsubmit="return confirm('Yakin ingin menghapus rekam medis ini? Semua tindakan terapi terkait juga akan terhapus!');">        <div class="info-card">

                    @csrf            <h3>Informasi Rekam Medis</h3>

                    @method('DELETE')            

                    <button type="submit" class="btn btn-danger">Hapus Rekam Medis</button>            <!-- Grid informasi umum rekam medis -->

                </form>            <div class="info-grid">

            </div>                <!-- Tanggal pembuatan rekam medis -->

        </div>                <div class="info-item">

                    <strong>Tanggal Dibuat:</strong> 

        <!-- SECTION 2: Manajemen Tindakan Terapi -->                    <?php echo date('d/m/Y H:i', strtotime($rekamData['created_at'])); ?>

        <div class="section">                </div>

            <h3>Tindakan Terapi</h3>                

                            <!-- Nomor urut temu dokter -->

            <!-- SUB-SECTION: Form untuk menambah tindakan terapi baru -->                <div class="info-item">

            <div class="add-therapy-form">                    <strong>No. Urut Temu:</strong> 

                <h4>Tambah Tindakan Terapi</h4>                    <?php echo htmlspecialchars($rekamData['no_urut'] ?? '-'); ?>

                <form action="{{ route('perawat.detail-rekam-medis.store') }}" method="POST" class="inline-form">                </div>

                    @csrf                

                    <!-- Hidden fields untuk identifikasi -->                <!-- Nama hewan peliharaan -->

                    <input type="hidden" name="idrekam_medis" value="{{ $rekamMedis->idrekam_medis }}">                <div class="info-item">

                                        <strong>Nama Pet:</strong> 

                    <div class="form-row">                    <?php echo htmlspecialchars($rekamData['nama_pet'] ?? '-'); ?>

                        <!-- Dropdown untuk memilih kode tindakan terapi -->                </div>

                        <select name="idkode_tindakan_terapi" required>                

                            <option value="">Pilih Kode Tindakan</option>                <!-- Nama pemilik hewan -->

                            @foreach($kodeTindakanTerapi as $kode)                <div class="info-item">

                                <option value="{{ $kode->idkode_tindakan_terapi }}">                    <strong>Pemilik:</strong> 

                                    {{ $kode->kode }} - {{ $kode->deskripsi_tindakan_terapi }}                    <?php echo htmlspecialchars($rekamData['nama_pemilik'] ?? '-'); ?>

                                </option>                </div>

                            @endforeach                

                        </select>                <!-- Nama dokter pemeriksa -->

                                        <div class="info-item">

                        <!-- Input untuk detail tindakan spesifik -->                    <strong>Dokter Pemeriksa:</strong> 

                        <input type="text" name="detail" placeholder="Detail tindakan..." required>                    <?php echo htmlspecialchars($rekamData['nama_dokter'] ?? '-'); ?>

                                        </div>

                        <!-- Button submit untuk menambah tindakan -->            </div>

                        <button type="submit" class="btn btn-primary">Tambah</button>            

                    </div>            <!-- Detail medis lengkap -->

                </form>            <div class="medical-details">

            </div>                <!-- Anamnesa: riwayat yang diceritakan pemilik -->

                <div class="detail-section">

            <!-- SUB-SECTION: Daftar tindakan terapi yang sudah ada -->                    <h4>Anamnesa:</h4>

            @if($rekamMedis->detailRekamMedis->isNotEmpty())                    <p> <?php echo nl2br(htmlspecialchars($rekamData['anamnesa'] ?? '-')); ?></p>

            <div class="table-container">                </div>

                <table>                

                    <thead>                <!-- Temuan klinis: hasil pemeriksaan fisik -->

                        <tr>                <div class="detail-section">

                            <th>Kode</th>                    <h4>Temuan Klinis:</h4>

                            <th>Kategori</th>                    <p><?php echo nl2br(htmlspecialchars($rekamData['temuan_klinis'] ?? '-')); ?></p>

                            <th>Kategori Klinis</th>                </div>

                            <th>Deskripsi Tindakan</th>                

                            <th>Detail</th>                <!-- Diagnosa: kesimpulan dokter -->

                            <th>Aksi</th>                <div class="detail-section">

                        </tr>                    <h4>Diagnosa:</h4>

                    </thead>                    <p><?php echo nl2br(htmlspecialchars($rekamData['diagnosa'] ?? '-')); ?></p>

                    <tbody>                </div>

                        @foreach($rekamMedis->detailRekamMedis as $detail)            </div>

                        <tr>            

                            <!-- Kode tindakan -->            <!-- Action buttons untuk operasi rekam medis -->

                            <td>{{ $detail->kodeTindakanTerapi->kode ?? '-' }}</td>            <div class="actions">

                                            <!-- Button untuk hapus rekam medis dengan konfirmasi ketat -->

                            <!-- Kategori tindakan -->                <a href="../../logic/perawat/rekam_medis_process.php?action=delete&id=<?php echo $rekam_id; ?>" 

                            <td>{{ $detail->kodeTindakanTerapi->kategori->nama_kategori ?? '-' }}</td>                   onclick="return confirmDeleteDetail()" 

                                               class="btn btn-danger">Hapus Rekam Medis</a>

                            <!-- Kategori klinis -->            </div>

                            <td>{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>        </div>

                            

                            <!-- Deskripsi tindakan terapi -->

                            <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</td>        <!-- SECTION 2: Manajemen Tindakan Terapi -->

                            

                            <!-- Detail spesifik yang diinput perawat -->        <div class="section">

                            <td>{{ $detail->detail ?? '-' }}</td>            <h3>Tindakan Terapi</h3>

                                        

                            <!-- Action buttons untuk edit dan hapus -->

                            <td>            <!-- SUB-SECTION: Form untuk menambah tindakan terapi baru -->

                                <!-- Button edit tindakan -->

                                <a href="{{ route('perawat.detail-rekam-medis.edit', $detail->iddetail_rekam_medis) }}"             <div class="add-therapy-form">

                                   class="btn btn-sm btn-warning">Edit</a>                <h4>Tambah Tindakan Terapi</h4>

                                                <form action="../../logic/perawat/detail_rekam_medis_process.php" method="POST" class="inline-form">

                                <!-- Form hapus tindakan dengan konfirmasi -->                    <!-- Hidden fields untuk identifikasi -->

                                <form action="{{ route('perawat.detail-rekam-medis.delete', $detail->iddetail_rekam_medis) }}"                     <input type="hidden" name="action" value="create">

                                      method="POST"                     <input type="hidden" name="idrekam_medis" value="<?php echo $rekam_id; ?>">

                                      style="display: inline;"                    

                                      onsubmit="return confirm('Yakin ingin menghapus tindakan terapi ini?');">                    <div class="form-row">

                                    @csrf                        <!-- Dropdown untuk memilih kode tindakan terapi -->

                                    @method('DELETE')                        <select name="idkode_tindakan_terapi" required>

                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>                            <option value="">Pilih Kode Tindakan</option>

                                </form>                            <?php 

                            </td>                            // Loop untuk menampilkan semua kode tindakan terapi yang tersedia

                        </tr>                            // Data sudah ter-join dengan kategori dan deskripsi

                        @endforeach                            foreach ($kodeTindakanTerapi as $kode): 

                    </tbody>                            ?>

                </table>                                <option value="<?php echo $kode['idkode_tindakan_terapi']; ?>">

            </div>                                    <?php echo htmlspecialchars($kode['kode'] . ' - ' . $kode['deskripsi_tindakan_terapi']); ?>

            @else                                </option>

            <!-- Empty state ketika belum ada tindakan terapi -->                            <?php endforeach; ?>

            <div class="no-data">                        </select>

                <p>Belum ada tindakan terapi yang tercatat.</p>                        

            </div>                        <!-- Input untuk detail tindakan spesifik -->

            @endif                        <input type="text" name="detail" placeholder="Detail tindakan..." required>

        </div>                        

    </div>                        <!-- Button submit untuk menambah tindakan -->

</body>                        <button type="submit" class="btn btn-primary">Tambah</button>

</html>                    </div>

                </form>
            </div>


            <!-- SUB-SECTION: Daftar tindakan terapi yang sudah ada -->

            <?php 
            // Conditional rendering berdasarkan ada tidaknya data tindakan terapi
            // Jika ada data, tampilkan tabel, jika tidak tampilkan pesan kosong
            if (!empty($detailData)): 
            ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Kategori Klinis</th>
                            <th>Deskripsi Tindakan</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Loop untuk menampilkan setiap tindakan terapi
                        // Data sudah lengkap dengan informasi kategori dan deskripsi
                        foreach ($detailData as $detail): 
                        ?>
                        <tr>
                            <!-- Kode tindakan -->
                            <td><?php echo htmlspecialchars($detail['kode'] ?? '-'); ?></td>
                            
                            <!-- Kategori tindakan -->
                            <td><?php echo htmlspecialchars($detail['nama_kategori'] ?? '-'); ?></td>
                            
                            <!-- Kategori klinis -->
                            <td><?php echo htmlspecialchars($detail['nama_kategori_klinis'] ?? '-'); ?></td>
                            
                            <!-- Deskripsi tindakan terapi -->
                            <td><?php echo htmlspecialchars($detail['deskripsi_tindakan_terapi'] ?? '-'); ?></td>
                            
                            <!-- Detail spesifik yang diinput perawat -->
                            <td><?php echo htmlspecialchars($detail['detail'] ?? '-'); ?></td>
                            
                            <!-- Action buttons untuk edit dan hapus -->
                            <td>
                                <!-- Button edit tindakan -->
                                <a href="edit_detail_rekam_medis.php?id=<?php echo $detail['iddetail_rekam_medis']; ?>" 
                                   class="btn btn-sm btn-warning">Edit</a>
                                
                                <!-- Button hapus tindakan dengan konfirmasi -->
                                <a href="../../logic/perawat/detail_rekam_medis_process.php?action=delete&id=<?php echo $detail['iddetail_rekam_medis']; ?>&rekam_id=<?php echo $rekam_id; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus tindakan terapi ini?')" 
                                   class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <!-- Empty state ketika belum ada tindakan terapi -->
            <div class="no-data">
                <p>Belum ada tindakan terapi yang tercatat.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
