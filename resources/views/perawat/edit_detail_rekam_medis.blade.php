<!DOCTYPE html><?php

<html lang="id">

<head>

    <meta charset="UTF-8">// =================================================================================

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// SECTION 1: INISIALISASI SESSION DAN VALIDASI AUTENTIKASI

    <title>Edit Detail Rekam Medis - Perawat RS Hewan UNAIR</title>// =================================================================================

    

    <!-- CSS Styling External -->/**

    <link rel="stylesheet" href="{{ asset('css/shared/style_rekam_medis.css') }}"> * Mulai session untuk tracking user login

     */

    <!-- Font Google untuk typography yang konsisten -->session_start();

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>/**

<body> * Validasi autentikasi user

    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit --> * Redirect ke login jika belum terautentikasi

    <div class="nav-content"> */

        <div class="logokiri">if (!isset($_SESSION['user'])) {

            <img src="{{ asset('img/unairr.png') }}" alt="Logo UNAIR">    header('Location: login.php');

        </div>    exit;

        <div class="text">}

            <h2>Universitas Airlangga |</h2>

        </div>// =================================================================================

        <div class="text2">// SECTION 2: IMPORT CLASS DAN INISIALISASI

            <h2>Rumah Sakit Hewan Pendidikan</h2>// =================================================================================

        </div>

        <div class="logokanan">/**

            <img src="{{ asset('img/rshpp.png') }}" alt="Logo RSHP"> * Import class yang dibutuhkan untuk operasi detail rekam medis

        </div> */

    </div>require_once __DIR__ . '/../../class/DetailRekamMedis.php';

require_once __DIR__ . '/../../class/KodeTindakanTerapi.php';

    <!-- NAVIGATION BAR: Menu navigasi dan logout -->

    <div class="navbar">/**

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a> * Ambil data user dari session dengan sanitasi

        <div class="navbar-nav"> */

            <a href="{{ route('perawat.detail-rekam-medis', $detailRekamMedis->idrekam_medis) }}">Back</a>$user = $_SESSION['user'];

            <a href="{{ route('logout') }}">Logout</a>$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

        </div>

    </div>// =================================================================================

// SECTION 3: VALIDASI DAN PENGAMBILAN ID DETAIL

    <!-- MAIN CONTENT: Container untuk semua konten halaman -->// =================================================================================

    <div class="container">

        <h1>Edit Detail Tindakan Terapi</h1>/**

         * Ambil ID detail rekam medis dari parameter URL

        <!-- Current Information --> * Validasi dan convert ke integer untuk keamanan

        <div class="info-card"> */

            <h3>Informasi Saat Ini</h3>$detail_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            <div class="info-grid">

                <div class="info-item">/**

                    <strong>Kode:</strong> {{ $detailRekamMedis->kodeTindakanTerapi->kode ?? '-' }} * Validasi ID detail tidak boleh 0 atau kosong

                </div> * Redirect ke halaman utama jika invalid

                <div class="info-item"> */

                    <strong>Kategori:</strong> {{ $detailRekamMedis->kodeTindakanTerapi->kategori->nama_kategori ?? '-' }}if ($detail_id == 0) {

                </div>    header('Location: rekam_medis_perawat.php?error=invalid_id');

                <div class="info-item">    exit;

                    <strong>Kategori Klinis:</strong> {{ $detailRekamMedis->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis ?? '-' }}}

                </div>

                <div class="info-item">// =================================================================================

                    <strong>Deskripsi Tindakan:</strong> {{ $detailRekamMedis->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}// SECTION 4: PENGAMBILAN DATA DETAIL DAN KODE TINDAKAN

                </div>// =================================================================================

            </div>

        </div>/**

 * Inisialisasi object dan ambil data detail berdasarkan ID

        <!-- Edit Form --> */

        <form action="{{ route('perawat.detail-rekam-medis.update', $detailRekamMedis->iddetail_rekam_medis) }}" method="POST" class="form-container">$detailRekamMedis = new DetailRekamMedis();

            @csrf$detailData = $detailRekamMedis->getById($detail_id);

            @method('PUT')

            /**

            <div class="form-group"> * Validasi keberadaan data detail

                <label for="idkode_tindakan_terapi">Kode Tindakan Terapi:</label> * Redirect jika data tidak ditemukan

                <select name="idkode_tindakan_terapi" id="idkode_tindakan_terapi" required> */

                    <option value="">Pilih Kode Tindakan</option>if (!$detailData) {

                    @foreach($kodeTindakanTerapi as $kode)    header('Location: rekam_medis_perawat.php?error=record_not_found');

                        <option value="{{ $kode->idkode_tindakan_terapi }}"    exit;

                                {{ old('idkode_tindakan_terapi', $detailRekamMedis->idkode_tindakan_terapi) == $kode->idkode_tindakan_terapi ? 'selected' : '' }}>}

                            {{ $kode->kode }} - {{ $kode->deskripsi_tindakan_terapi }}

                        </option>/**

                    @endforeach * Ambil semua kode tindakan terapi untuk dropdown

                </select> * Menggunakan method getAllJoined untuk mendapat data lengkap

                @error('idkode_tindakan_terapi') */

                    <span class="error-message">{{ $message }}</span>$kodeTindakanTerapiObj = new KodeTindakanTerapi();

                @enderror$kodeTindakanTerapi = $kodeTindakanTerapiObj->getAllJoined();

            </div>?>



            <div class="form-group"><!DOCTYPE html>

                <label for="detail">Detail Tindakan:</label><html lang="id">

                <textarea name="detail" id="detail" rows="4" placeholder="Masukkan detail tindakan yang dilakukan..." required>{{ old('detail', $detailRekamMedis->detail) }}</textarea><head>

                @error('detail')    <meta charset="UTF-8">

                    <span class="error-message">{{ $message }}</span>    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                @enderror    <title>Edit Detail Rekam Medis - Perawat RS Hewan UNAIR</title>

            </div>    

    <!-- CSS Styling External -->

            <div class="form-actions">    <link rel="stylesheet" href="../../css/shared/style_rekam_medis.css">

                <button type="submit" class="btn btn-primary">Update Detail</button>    

                <a href="{{ route('perawat.detail-rekam-medis', $detailRekamMedis->idrekam_medis) }}" class="btn btn-secondary">Batal</a>    <!-- Font Google untuk typography yang konsisten -->

            </div>    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        </form></head>

    </div><body>

</body>    <!-- =================================================================== -->

</html>    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->

    <!-- =================================================================== -->
    <div class="nav-content">
        <div class="logokiri">
            <img src="../../img/unairr.png" alt="Logo UNAIR">
        </div>
        <div class="text">
            <h2>Universitas Airlangga |</h2>
        </div>
            <h2>Universitas Airlangga |</h2>
        </div>
        <div class="text2">
            <h2>Rumah Sakit Hewan Pendidikan</h2>
        </div>
        <div class="logokanan">
            <img src="../../img/rshpp.png" alt="Logo RSHP">
        </div>
    </div>
    <!-- Logo End -->

    <!-- navbar start -->
    <div class="navbar">
        <a href="#" class="logo">RSHP<span> UNAIR.</a>
        <div class="navbar-nav">
            <a href="detail_rekam_medis.php?id=<?php echo $detailData['idrekam_medis']; ?>">Back</a>
            <a href="../../logic/login.php?action=logout">Logout</a>
        </div>
    </div>
    <!-- navbar end -->

    <div class="container">
        <h1>Edit Detail Tindakan Terapi</h1>
        
        <!-- Current Information -->
        <div class="info-card">
            <h3>Informasi Saat Ini</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Kode:</strong> <?php echo htmlspecialchars($detailData['kode'] ?? '-'); ?>
                </div>
                <div class="info-item">
                    <strong>Kategori:</strong> <?php echo htmlspecialchars($detailData['nama_kategori'] ?? '-'); ?>
                </div>
                <div class="info-item">
                    <strong>Kategori Klinis:</strong> <?php echo htmlspecialchars($detailData['nama_kategori_klinis'] ?? '-'); ?>
                </div>
                <div class="info-item">
                    <strong>Deskripsi Tindakan:</strong> <?php echo htmlspecialchars($detailData['deskripsi_tindakan_terapi'] ?? '-'); ?>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <form action="../../logic/perawat/detail_rekam_medis_process.php" method="POST" class="form-container">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="iddetail_rekam_medis" value="<?php echo $detail_id; ?>">
            <input type="hidden" name="idrekam_medis" value="<?php echo $detailData['idrekam_medis']; ?>">
            
            <div class="form-group">
                <label for="idkode_tindakan_terapi">Kode Tindakan Terapi:</label>
                <select name="idkode_tindakan_terapi" id="idkode_tindakan_terapi" required>
                    <option value="">Pilih Kode Tindakan</option>
                    <?php foreach ($kodeTindakanTerapi as $kode): ?>
                        <option value="<?php echo $kode['idkode_tindakan_terapi']; ?>"
                                <?php echo ($kode['idkode_tindakan_terapi'] == $detailData['idkode_tindakan_terapi']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($kode['kode'] . ' - ' . $kode['deskripsi_tindakan_terapi']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="detail">Detail Tindakan:</label>
                <textarea name="detail" id="detail" rows="4" placeholder="Masukkan detail tindakan yang dilakukan..." required><?php echo htmlspecialchars($detailData['detail'] ?? ''); ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Detail</button>
                <a href="detail_rekam_medis.php?id=<?php echo $detailData['idrekam_medis']; ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>