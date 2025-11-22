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
                <h1 class="page-title">Data Dokter</h1>
                <p class="page-subtitle">Kelola data dokter yang terdaftar dalam sistem.</p>
            </div>
            
            <!-- ========== BUTTON SECTION ========== -->
            <div class="button-section">
                <a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">+ Tambah Dokter</a>
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

            <!-- ========== TABEL DATA DOKTER ========== -->
            <div class="table-container">
                <table class="data-table">
                    <!-- Header tabel -->
                    <thead>
                        <tr>
                            <th class="col-id">ID</th>
                            <th class="col-name">NAMA DOKTER</th>
                            <th class="col-specialty">BIDANG/SPESIALISASI</th>
                            <th class="col-phone">NO. HP</th>
                            <th class="col-gender">JENIS KELAMIN</th>
                            <th class="col-action">AKSI</th>
                        </tr>
                    </thead>
                    
                    <!-- Data rows -->
                    <tbody>
                        <!-- Loop untuk menampilkan setiap dokter -->
                        @forelse($dokterList as $dokter)
                        <tr>
                            <!-- ID Dokter -->
                            <td class="col-id">{{ $dokter->id_dokter }}</td>

                            <!-- Nama Dokter (dari user) -->
                            <td class="col-name">
                                <div class="user-info">
                                    <div class="user-name">{{ $dokter->user->nama ?? '-' }}</div>
                                    <div class="user-email">{{ $dokter->user->email ?? '-' }}</div>
                                </div>
                            </td>

                            <!-- Bidang Dokter -->
                            <td class="col-specialty">{{ $dokter->bidang_dokter }}</td>

                            <!-- No HP -->
                            <td class="col-phone">{{ $dokter->no_hp }}</td>

                            <!-- Jenis Kelamin -->
                            <td class="col-gender">
                                <span class="badge {{ $dokter->jenis_kelamin == 'L' ? 'badge-blue' : 'badge-pink' }}">
                                    {{ $dokter->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="col-action">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.dokter.edit', $dokter->id_dokter) }}" 
                                       class="btn-action btn-edit" 
                                       title="Edit">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.dokter.destroy', $dokter->id_dokter) }}" 
                                          method="POST" 
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini dari daftar? (Role dokter tidak akan dihapus)');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-action btn-delete" 
                                                title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="6" style="text-align: center; padding: 40px; color: #999;">
                                Belum ada data dokter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- END TABLE -->
        </div>
        <!-- END MAIN CONTENT WRAPPER -->
    </div>
    <!-- END CONTAINER -->
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
