@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
    <!-- ========== MAIN CONTENT ========== -->
    <div class="container">
        <!-- ========== MAIN CONTENT WRAPPER ========== -->
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Data Perawat</h1>
                <p class="page-subtitle">Kelola data perawat yang terdaftar dalam sistem.</p>
            </div>
            
            <!-- ========== BUTTON SECTION ========== -->
            <div class="button-section">
                <a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                <a href="{{ route('admin.perawat.create') }}" class="btn btn-primary">+ Tambah Perawat</a>
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

            <!-- ========== TABEL DATA PERAWAT ========== -->
            <div class="table-container">
                <table class="data-table">
                    <!-- Header tabel -->
                    <thead>
                        <tr>
                            <th class="col-id">ID</th>
                            <th class="col-name">NAMA PERAWAT</th>
                            <th class="col-phone">NO. HP</th>
                            <th class="col-address">ALAMAT</th>
                            <th class="col-gender">JENIS KELAMIN</th>
                            <th class="col-action">AKSI</th>
                        </tr>
                    </thead>
                    
                    <!-- Data rows -->
                    <tbody>
                        <!-- Loop untuk menampilkan setiap perawat -->
                        @forelse($perawatList as $perawat)
                        <tr>
                            <!-- ID Perawat -->
                            <td class="col-id">{{ $perawat->id_perawat }}</td>

                            <!-- Nama Perawat (dari user) -->
                            <td class="col-name">
                                <div class="user-info">
                                    <div class="user-name">{{ $perawat->user->nama ?? '-' }}</div>
                                    <div class="user-email">{{ $perawat->user->email ?? '-' }}</div>
                                </div>
                            </td>

                            <!-- No HP -->
                            <td class="col-phone">{{ $perawat->no_hp }}</td>

                            <!-- Alamat -->
                            <td class="col-address">{{ $perawat->alamat }}</td>

                            <!-- Jenis Kelamin -->
                            <td class="col-gender">
                                <span class="badge {{ $perawat->jenis_kelamin == 'L' ? 'badge-blue' : 'badge-pink' }}">
                                    {{ $perawat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>

                            <!-- Aksi (Edit & Delete) -->
                            <td class="col-action">
                                <a href="{{ route('admin.perawat.edit', $perawat->id_perawat) }}" 
                                   class="btn-action btn-edit">Edit</a>
                                
                                <form action="{{ route('admin.perawat.destroy', $perawat->id_perawat) }}" 
                                      method="POST" 
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Yakin ingin menghapus perawat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <div class="empty-icon">📋</div>
                                <p>Belum ada data perawat yang terdaftar.</p>
                                <a href="{{ route('admin.perawat.create') }}" class="btn btn-primary btn-sm">+ Tambah Perawat</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
