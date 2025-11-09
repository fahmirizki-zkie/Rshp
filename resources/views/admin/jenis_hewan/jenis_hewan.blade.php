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
                <a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        
        <!-- ========== ALERT MESSAGES ========== -->
        @if(session('success'))
            <div class="alert alert--success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert--error">
                {{ session('error') }}
            </div>
        @endif

        <!-- ========== FORM TAMBAH JENIS HEWAN ========== -->
        <div class="add-form-section">
            <h3 class="form-title">Tambah Jenis Hewan Baru</h3>
            <form class="form-row" method="POST" action="{{ route('admin.jenis-hewan.store') }}">
                @csrf
                <input type="text"
                       name="nama_jenis_hewan"
                       value="{{ old('nama_jenis_hewan') }}"
                       placeholder="Masukkan nama jenis hewan baru"
                       required
                       maxlength="100"
                       class="form-input @error('nama_jenis_hewan') is-invalid @enderror" />
                <button type="submit" class="btn-add">+ Tambah Jenis</button>
            </form>
            @error('nama_jenis_hewan')
                <span class="error-message" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>
        <!-- ========== TABEL DATA JENIS HEWAN ========== -->
        <div class="table-container">
            <table class="data-table">
                <!-- Header tabel -->
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-name">NAMA JENIS HEWAN</th>
                        <th class="col-action">AKSI</th>
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

                        <!-- Aksi -->
                        <td class="col-action">
                            <a href="{{ route('admin.jenis-hewan.edit', $jenis->idjenis_hewan) }}" class="btn-edit">Edit</a>
                            <form method="POST" action="{{ route('admin.jenis-hewan.destroy', $jenis->idjenis_hewan) }}" style="display: inline;" onsubmit="return confirm('Yakin hapus jenis hewan {{ $jenis->nama_jenis_hewan }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="3">Belum ada data jenis hewan. Silakan tambah jenis hewan baru.</td>
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