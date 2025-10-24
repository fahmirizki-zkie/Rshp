<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemilik - Admin RSHP</title>
    <link rel="stylesheet" href="{{ asset('css/style_data_pemilik_new.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTENT ========== -->
    <div class="container">
        <!-- ========== MAIN CONTENT WRAPPER ========== -->
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Data Pemilik</h1>
                <p class="page-subtitle">Kelola data pemilik hewan yang terdaftar dalam sistem.</p>
            </div>
        
        <!-- ========== BUTTON SECTION ========== -->
        <div class="button-section">
            <!-- Tombol navigasi berdasarkan role -->
            @if(isset($role) && $role === 'resepsionis')
                <a class="btn btn-primary" href="{{ route('resepsionis.tambah-pemilik') }}">+ Tambah Pemilik</a>
                <a class="btn btn-secondary" href="{{ route('resepsionis.dashboard') }}">Kembali ke Dashboard</a>
            @endif
            
            @if(isset($role) && $role === 'administrator')
                <a class="btn btn-secondary" href="{{ route('admin.data-master') }}">Kembali ke Dashboard</a>
            @endif
        </div>
        
        <!-- ========== TABEL DATA PEMILIK ========== -->
        <div class="table-container">
            <table class="data-table {{ isset($role) && $role === 'administrator' ? 'role-admin' : 'role-resepsionis' }}">
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-name">NAMA PEMILIK</th>
                        <th class="col-wa">NO WHATSAPP</th>
                        <th class="col-address">ALAMAT</th>
                        <th class="col-userid">ID USER</th>
                        @if(isset($role) && $role === 'administrator')
                            <th class="col-action">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemilikList as $p)
                    <tr>
                        <td class="col-id">{{ $p->idpemilik }}</td>
                        <td class="col-name">{{ $p->user->nama ?? 'N/A' }}</td>
                        <td class="col-wa">{{ $p->no_wa }}</td>
                        <td class="col-address">{{ $p->alamat }}</td>
                        <td class="col-userid">{{ $p->iduser }}</td>
                        
                        <!-- Tombol aksi hanya untuk administrator -->
                        @if(isset($role) && $role === 'administrator')
                        <td class="col-action">
                            <div class="actions-inline">
                                <a class="btn-edit" href="{{ route('admin.pemilik.edit', $p->iduser) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data pemilik ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="{{ isset($role) && $role === 'administrator' ? '6' : '5' }}">Belum ada data pemilik terdaftar.</td>
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
