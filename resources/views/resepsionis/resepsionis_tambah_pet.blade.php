<!DOCTYPE html>

<html lang="id">// Form untuk menambahkan data pet (hewan) baru oleh resepsionis

<head>

    <meta charset="UTF-8">// Import class yang diperlukan

    <meta name="viewport" content="width=device-width, initial-scale=1.0">require_once __DIR__ . '/../../class/Pemilik.php';

    <title>Tambah Pet - Resepsionis RS Hewan UNAIR</title>require_once __DIR__ . '/../../class/RasHewan.php';

    

    <!-- CSS Styling External -->// Inisialisasi session dan validasi role

    <link rel="stylesheet" href="{{ asset('css/resepsionis/style_resepsionis.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/style_data_master_new.css') }}">//Mulai session jika belum active

    //Menggunakan PHP_SESSION_NONE untuk menghindari multiple session start

    <!-- Font Google untuk typography yang konsisten -->if (session_status() === PHP_SESSION_NONE) session_start();

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>//Validasi role user - hanya resepsionis yang bisa akses

<body>//Redirect jika bukan resepsionis

    <!-- Main container: Form tambah pet -->$role = strtolower($_SESSION['user']['nama_role'] ?? '');

    <div class="container-small">if ($role !== 'resepsionis') { 

        <!-- Navigation back ke data pet -->    header('Location: ./data_pet.php'); 

        <a href="{{ route('admin.pet.index') }}" class="back-link">    exit; 

            &larr; Kembali ke Data Pet}

        </a>// SECTION 2: IMPORT DEPENDENCIES DAN INISIALISASI DATABASE

        

        <!-- Form tambah pet baru -->//Import database connection

        <div class="form-box">require_once __DIR__ . '/../../connection/DBconnection.php';

            <h3>Tambah Data Pet</h3>

            //Inisialisasi koneksi database

            <!-- Form dengan action ke route Laravel -->$db = new DBconnection();

            <form method="POST" action="{{ route('resepsionis.pet.store') }}">$mysqli = $db->getMysqli();

                @csrf

                // SECTION 3: PENGAMBILAN DATA UNTUK DROPDOWN

                <!-- Dropdown Pemilik Selection -->

                <div class="form-group">// Ambil data pemilik dengan nama user untuk dropdown

                    <label for="idpemilik">Pilih Pemilik <span class="required">*</span></label>$pemilikObj = new Pemilik();

                    <select name="idpemilik" id="idpemilik" required>$pemiliks = $pemilikObj->getAllWithUserName();

                        <option value="" disabled selected>-- Pilih Pemilik --</option>

                        @forelse($pemiliks as $pemilik)// Ambil data ras hewan untuk dropdown

                            <option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>$rasObj = new RasHewan($mysqli);

                                {{ $pemilik->idpemilik }} - {{ $pemilik->user->nama }}$rasList = $rasObj->getAllOrderedByName();

                            </option>

                        @empty// Tutup koneksi

                            <option value="" disabled>Tidak ada pemilik tersedia</option>$db->close_connection();

                        @endforelse?>

                    </select>

                    <small class="form-help"><!DOCTYPE html>

                        Catatan: Pilih pemilik yang sudah terdaftar di sistem<html lang="id">

                    </small><head>

                    @error('idpemilik')    <meta charset="UTF-8">

                        <span class="error-message">{{ $message }}</span>    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                    @enderror    <title>Tambah Pet - Resepsionis RS Hewan UNAIR</title>

                </div>    

                    <!-- CSS Styling External -->

                <!-- Dropdown Ras Hewan -->    <link rel="stylesheet" href="../../css/resepsionis/style_resepsionis.css">

                <div class="form-group">    <link rel="stylesheet" href="../../css/shared/style_data_master_new.css">

                    <label for="idras_hewan">Ras Hewan <span class="required">*</span></label>    

                    <select name="idras_hewan" id="idras_hewan" required>    <!-- Font Google untuk typography yang konsisten -->

                        <option value="" disabled selected>-- Pilih Ras --</option>    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                        @forelse($rasList as $ras)</head>

                            <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}><body>

                                {{ $ras->nama_ras }}    <!-- Main container: Form tambah pet -->

                            </option>    <div class="container-small">

                        @empty        <!-- Navigation back ke data pet -->

                            <option value="" disabled>Tidak ada ras hewan tersedia</option>        <a href="../../admin/data_pet/data_pet.php" class="back-link">

                        @endforelse            &larr; Kembali ke Data Pet

                    </select>        </a>

                    <small class="form-help">        

                        Catatan: Pilih ras hewan yang sesuai        <!-- Form tambah pet baru -->

                    </small>        <div class="form-box">

                    @error('idras_hewan')            <h3>Tambah Data Pet</h3>

                        <span class="error-message">{{ $message }}</span>            

                    @enderror            <!-- Form dengan action ke logic pemrosesan -->

                </div>            <form method="POST" action="../../logic/admin/data_pet_process.php">

                                <!-- Hidden field untuk identifikasi aksi -->

                <!-- Input Nama Pet -->                <input type="hidden" name="aksi" value="tambah">

                <div class="form-group">                

                    <label for="nama">Nama Pet <span class="required">*</span></label>                <!-- Dropdown Pemilik Selection -->

                    <input type="text" name="nama" id="nama" required                 <div class="form-group">

                           placeholder="Masukkan nama hewan"                    <label for="idpemilik">Pilih Pemilik <span class="required">*</span></label>

                           value="{{ old('nama') }}">                    <select name="idpemilik" id="idpemilik" required>

                    <small class="form-help">                        <option value="" disabled selected>-- Pilih Pemilik --</option>

                        Catatan: Nama hewan yang mudah diingat dan dipanggil                        <?php if ($pemiliks && count($pemiliks) > 0): ?>

                    </small>                            <?php foreach ($pemiliks as $p): ?>

                    @error('nama')                                <option value="<?php echo htmlspecialchars($p['idpemilik']); ?>">

                        <span class="error-message">{{ $message }}</span>                                    <?php echo htmlspecialchars($p['idpemilik']) . ' - ' . htmlspecialchars($p['nama']); ?>

                    @enderror                                </option>

                </div>                            <?php endforeach; ?>

                                        <?php else: ?>

                <!-- Input Tanggal Lahir -->                            <option value="" disabled>Tidak ada pemilik tersedia</option>

                <div class="form-group">                        <?php endif; ?>

                    <label for="tanggal_lahir">Tanggal Lahir</label>                    </select>

                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"                    <small class="form-help">

                           value="{{ old('tanggal_lahir') }}">                        Catatan: Pilih pemilik yang sudah terdaftar di sistem

                    <small class="form-help">                    </small>

                        Catatan: Tanggal lahir untuk menghitung umur hewan (opsional)                </div>

                    </small>                

                    @error('tanggal_lahir')                <!-- Dropdown Ras Hewan -->

                        <span class="error-message">{{ $message }}</span>                <div class="form-group">

                    @enderror                    <label for="idras_hewan">Ras Hewan <span class="required">*</span></label>

                </div>                    <select name="idras_hewan" id="idras_hewan" required>

                                        <option value="" disabled selected>-- Pilih Ras --</option>

                <!-- Input Warna Tanda -->                        <?php if ($rasList && count($rasList) > 0): ?>

                <div class="form-group">                            <?php foreach ($rasList as $r): ?>

                    <label for="warna_tanda">Warna/Tanda Khusus</label>                                <option value="<?php echo htmlspecialchars($r['idras_hewan']); ?>">

                    <input type="text" name="warna_tanda" id="warna_tanda"                                     <?php echo htmlspecialchars($r['nama_ras']); ?>

                           placeholder="Contoh: Hitam putih, tanda di dahi"                                </option>

                           value="{{ old('warna_tanda') }}">                            <?php endforeach; ?>

                    <small class="form-help">                        <?php else: ?>

                        Catatan: Deskripsi warna atau tanda khusus untuk identifikasi                            <option value="" disabled>Tidak ada ras hewan tersedia</option>

                    </small>                        <?php endif; ?>

                    @error('warna_tanda')                    </select>

                        <span class="error-message">{{ $message }}</span>                    <small class="form-help">

                    @enderror                        Catatan: Pilih ras hewan yang sesuai

                </div>                    </small>

                                </div>

                <!-- Dropdown Jenis Kelamin -->                

                <div class="form-group">                <!-- Input Nama Pet -->

                    <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>                <div class="form-group">

                    <select name="jenis_kelamin" id="jenis_kelamin" required>                    <label for="nama">Nama Pet <span class="required">*</span></label>

                        <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>-- Pilih Kelamin --</option>                    <input type="text" name="nama" id="nama" required 

                        <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>                           placeholder="Masukkan nama hewan">

                        <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>                    <small class="form-help">

                    </select>                        Catatan: Nama hewan yang mudah diingat dan dipanggil

                    <small class="form-help">                    </small>

                        Catatan: Pilih jenis kelamin hewan                </div>

                    </small>                

                    @error('jenis_kelamin')                <!-- Input Tanggal Lahir -->

                        <span class="error-message">{{ $message }}</span>                <div class="form-group">

                    @enderror                    <label for="tanggal_lahir">Tanggal Lahir</label>

                </div>                    <input type="date" name="tanggal_lahir" id="tanggal_lahir">

                                    <small class="form-help">

                <!-- Action Buttons -->                        Catatan: Tanggal lahir untuk menghitung umur hewan (opsional)

                <div class="modal-actions right">                    </small>

                    <a class="btn secondary" href="{{ route('admin.pet.index') }}">                </div>

                        Batal                

                    </a>                <!-- Input Warna Tanda -->

                    <button type="submit" class="btn">                <div class="form-group">

                        Simpan Data Pet                    <label for="warna_tanda">Warna/Tanda Khusus</label>

                    </button>                    <input type="text" name="warna_tanda" id="warna_tanda" 

                </div>                           placeholder="Contoh: Hitam putih, tanda di dahi">

            </form>                    <small class="form-help">

        </div>                        Catatan: Deskripsi warna atau tanda khusus untuk identifikasi

    </div>                    </small>

                </div>

</body>                

</html>                <!-- Dropdown Jenis Kelamin -->

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="" disabled selected>-- Pilih Kelamin --</option>
                        <option value="J">Jantan</option>
                        <option value="B">Betina</option>
                    </select>
                    <small class="form-help">
                        Catatan: Pilih jenis kelamin hewan
                    </small>
                </div>
                
                <!-- Action Buttons -->
                <div class="modal-actions right">
                    <a class="btn secondary" href="../admin/data_pet/data_pet.php">
                        Batal
                    </a>
                    <button type="submit" class="btn">
                        Simpan Data Pet
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
