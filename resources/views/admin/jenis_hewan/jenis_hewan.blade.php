<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jenis Hewan - Administrator</title>
    
    <!-- CSS Files untuk styling -->
    <link rel="stylesheet" href="{{ asset('css/style_jenis_hewan.css') }}" />
</head>
<body>
    <!-- ========== MAIN CONTENT ========== -->
    <div class="container">
        <!-- ========== MAIN CONTENT WRAPPER ========== -->
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Data Jenis Hewan</h1>
                <p class="page-subtitle">Kelola jenis hewan yang tersedia dalam sistem.</p>
            </div>
            
            <!-- ========== BUTTON SECTION ========== -->
            <div class="button-section">
                <a href="{{ url('/data_master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        
        <!-- ========== ALERT MESSAGES ========== -->
        @php
            $status = session('status') ?? request('status');
            $msg = session('msg') ?? request('msg');
        @endphp
        @if(!empty($status) && !empty($msg))
            @php $alertClass = $status === 'success' ? 'alert--success' : 'alert--error'; @endphp
            <div class="alert {{ $alertClass }}">
                {{ $msg }}
            </div>
        @endif

        <!-- ========== FORM TAMBAH JENIS HEWAN (disabled) ========== -->
        {{--
        Contoh form Laravel (dinonaktifkan). Jika ingin mengaktifkan, buat route 'jenis.store' di web.php dan controller menyimpan data.
        <div class="add-form-section">
            <h3 class="form-title">Tambah Jenis Hewan Baru</h3>
            <form class="form-row" method="POST" action="{{ route('jenis.store') }}">
                @csrf
                <input type="text"
                       name="nama_jenis"
                       placeholder="Masukkan nama jenis hewan baru"
                       required
                       maxlength="100"
                       class="form-input" />
                <button type="submit" class="btn-add">+ Tambah Jenis</button>
            </form>
        </div>
        --}}
        <!-- ========== TABEL DATA JENIS HEWAN ========== -->
        <div class="table-container">
            <table class="data-table">
                <!-- Header tabel -->
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-name">NAMA JENIS HEWAN</th>
                    </tr>
                </thead>
                
                <!-- Data rows -->
                <tbody>
                    <!-- Loop untuk menampilkan setiap jenis hewan -->
                    @forelse($jenisHewan as $jenis)
                    <tr>
                        <!-- ID Jenis Hewan -->
                        <td class="col-id">{{ $jenis->idjenis_hewan }}</td>

                        <!-- Nama Jenis Hewan -->
                        <td class="col-name">{{ $jenis->nama_jenis_hewan }}</td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="2">Belum ada data jenis hewan. Silakan tambah jenis hewan baru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END MAIN CONTENT WRAPPER -->
        </div>
    </div>
</body>
</html>