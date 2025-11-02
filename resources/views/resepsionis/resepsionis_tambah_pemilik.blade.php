<!DOCTYPE html>

<html lang="id">// Form untuk menambahkan data pemilik hewan baru oleh resepsionis

<head>// Role yang dapat mengakses: Resepsionis

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// SECTION 1: INISIALISASI SESSION DAN VALIDASI ROLE

    <title>Tambah Pemilik - Resepsionis RS Hewan UNAIR</title>

    // Mulai session jika belum active

    <!-- CSS Styling External -->// Menggunakan PHP_SESSION_NONE untuk menghindari multiple session start

    <link rel="stylesheet" href="{{ asset('css/resepsionis/style_resepsionis.css') }}">if (session_status() === PHP_SESSION_NONE) session_start();

    <link rel="stylesheet" href="{{ asset('css/shared/style_data_master_new.css') }}">

    /**

    <!-- Font Google untuk typography yang konsisten --> * Validasi role user - hanya resepsionis yang bisa akses

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> * Ambil role dari session dan validasi dengan ketat

</head> */

<body>$role = strtolower(trim($_SESSION['user']['nama_role'] ?? ''));

    <!-- MAIN CONTAINER: Form container dengan navigation back -->if ($role !== 'resepsionis') {

    <div class="container-small">    header('Location: ../login.php');

        <!-- Navigation back ke data pemilik -->    exit;

        <a href="{{ route('admin.pemilik.index') }}" class="back-link">}

            &larr; Kembali ke Data Pemilik

        </a>// SECTION 2: IMPORT DEPENDENCIES DAN INISIALISASI DATABASE



        <!-- FORM SECTION: Form tambah pemilik baru -->// Import class yang dibutuhkan untuk operasi database

        <div class="form-box">require_once __DIR__ .'/../../connection/DBconnection.php';

            <h3>Tambah Data Pemilik</h3>require_once __DIR__ .'/../../class/User.php';

            

            <!-- Form dengan action ke route Laravel -->// SECTION 3: PENGAMBILAN DATA USER UNTUK DROPDOWN

            <form method="POST" action="{{ route('resepsionis.pemilik.store') }}">

                @csrf// Inisialisasi koneksi database dan model User

                // Ambil semua data user untuk dropdown selection

                <!-- Dropdown User Selection -->$db = new DBconnection();

                <div class="form-group">$userModel = new User($db->getMysqli());

                    <label for="iduser">Pilih User <span class="required">*</span></label>$users = $userModel->getAll();

                    <select name="iduser" id="iduser" required>

                        <option value="" disabled selected>-- Pilih User --</option>// Tutup koneksi database setelah pengambilan data

                        @forelse($users as $user)// Good practice untuk resource management

                            <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>$db->close_connection();

                                {{ $user->iduser }} - {{ $user->nama }}?>

                            </option>

                        @empty<!DOCTYPE html>

                            <option value="" disabled>Tidak ada user tersedia</option><html lang="id">

                        @endforelse<head>

                    </select>    <meta charset="UTF-8">

                    <small class="form-help">    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                        Catatan: Pilih user yang akan dijadikan pemilik hewan    <title>Tambah Pemilik - Resepsionis RS Hewan UNAIR</title>

                    </small>    

                    @error('iduser')    <!-- CSS Styling External -->

                        <span class="error-message">{{ $message }}</span>    <link rel="stylesheet" href="../../css/resepsionis/style_resepsionis.css">

                    @enderror    <link rel="stylesheet" href="../../css/shared/style_data_master_new.css">

                </div>    

                    <!-- Font Google untuk typography yang konsisten -->

                <!-- Input Nomor WhatsApp -->    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                <div class="form-group"></head>

                    <label for="no_wa">No WhatsApp <span class="required">*</span></label><body>

                    <input type="text" name="no_wa" id="no_wa" required     <!-- MAIN CONTAINER: Form container dengan navigation back -->

                           placeholder="Contoh: 081234567890"    <div class="container-small">

                           value="{{ old('no_wa') }}">        <!-- Navigation back ke data pemilik -->

                    <small class="form-help">        <a href="../admin/data_pemilik/data_pemilik.php" class="back-link">

                        Catatan: Masukkan nomor WhatsApp aktif untuk komunikasi            &larr; Kembali ke Data Pemilik

                    </small>        </a>

                    @error('no_wa')

                        <span class="error-message">{{ $message }}</span>        <!-- FORM SECTION: Form tambah pemilik baru -->

                    @enderror        <div class="form-box">

                </div>            <h3>Tambah Data Pemilik</h3>

                            

                <!-- Input Alamat -->            <!-- Form dengan action ke logic pemrosesan -->

                <div class="form-group">            <form method="POST" action="../../logic/admin/data_pemilik_process.php">

                    <label for="alamat">Alamat <span class="required">*</span></label>                <!-- Hidden field untuk identifikasi aksi -->

                    <textarea name="alamat" id="alamat" rows="3" required                 <input type="hidden" name="aksi" value="tambah">

                              placeholder="Masukkan alamat lengkap pemilik">{{ old('alamat') }}</textarea>                

                    <small class="form-help">                <!-- Dropdown User Selection -->

                        Catatan: Alamat lengkap untuk keperluan administrasi dan komunikasi                <div class="form-group">

                    </small>                    <label for="iduser">Pilih User <span class="required">*</span></label>

                    @error('alamat')                    <select name="iduser" id="iduser" required>

                        <span class="error-message">{{ $message }}</span>                        <option value="" disabled selected>-- Pilih User --</option>

                    @enderror                        <?php if ($users && count($users) > 0): ?>

                </div>                            <?php foreach ($users as $u): ?>

                                                <option value="<?php echo htmlspecialchars($u['iduser']); ?>">

                <!-- Action Buttons -->                                    <?php echo htmlspecialchars($u['iduser']) . ' - ' . htmlspecialchars($u['nama']); ?>

                <div class="modal-actions right">                                </option>

                    <a class="btn secondary" href="{{ route('admin.pemilik.index') }}">                            <?php endforeach; ?>

                        Batal                        <?php else: ?>

                    </a>                            <option value="" disabled>Tidak ada user tersedia</option>

                    <button type="submit" class="btn">                        <?php endif; ?>

                        Simpan Data Pemilik                    </select>

                    </button>                    <small class="form-help">

                </div>                        Catatan: Pilih user yang akan dijadikan pemilik hewan

            </form>                    </small>

        </div>                </div>

    </div>                

</body>                <!-- Input Nomor WhatsApp -->

</html>                <div class="form-group">

                    <label for="no_wa">No WhatsApp <span class="required">*</span></label>
                    <input type="text" name="no_wa" id="no_wa" required 
                           placeholder="Contoh: 081234567890">
                    <small class="form-help">
                        Catatan: Masukkan nomor WhatsApp aktif untuk komunikasi
                    </small>
                </div>
                
                <!-- Input Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat <span class="required">*</span></label>
                    <textarea name="alamat" id="alamat" rows="3" required 
                              placeholder="Masukkan alamat lengkap pemilik"></textarea>
                    <small class="form-help">
                        Catatan: Alamat lengkap untuk keperluan administrasi dan komunikasi
                    </small>
                </div>
                
                <!-- Action Buttons -->
                <div class="modal-actions right">
                    <a class="btn secondary" href="../admin/data_pemilik/data_pemilik.php">
                        Batal
                    </a>
                    <button type="submit" class="btn">
                        Simpan Data Pemilik
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
