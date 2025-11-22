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
                <h1 class="page-title">Data Pet</h1>
                <p class="page-subtitle">Kelola data hewan peliharaan yang terdaftar dalam sistem.</p>
            </div>
        
        <!-- ========== BUTTON SECTION ========== -->
        <div class="button-section">
            {{-- CREATE DISABLED untuk admin: Tambah pet dilakukan oleh role lain --}}
            {{-- <a class="btn btn-primary" href="{{ route('admin.pet.create') }}">+ Tambah Pet</a> --}}
            <a class="btn btn-secondary" href="{{ route('admin.data-master') }}">Kembali ke Dashboard</a>
        </div>
        
        
        <!-- ========== DATA TABLE ========== -->
        <div class="table-container">
            <table class="data-table">
                <!-- TABLE HEADER -->
                <thead>
                    <tr>
                        <th class="col-id">ID PET</th>
                        <th class="col-name">NAMA</th>
                        <th class="col-birth">TGL LAHIR</th>
                        <th class="col-color">WARNA TANDA</th>
                        <th class="col-gender">KELAMIN</th>
                        <th class="col-breed">RAS</th>
                        <th class="col-owner">PEMILIK</th>
                        <th class="col-owner-id">ID PEMILIK</th>
                        <th class="col-action">AKSI</th>
                    </tr>
                </thead>
                
                <!-- TABLE BODY -->
                <tbody>
                    @forelse($pets as $pet)
                        <tr>
                            <td class="col-id">{{ $pet->id }}</td>
                            <td class="col-name">{{ $pet->nama }}</td>
                            <td class="col-birth">{{ $pet->tanggal_lahir }}</td>
                            <td class="col-color">{{ $pet->warna_tanda }}</td>
                            <td class="col-gender">
                                @if(strtolower($pet->jenis_kelamin) === 'jantan')
                                    <span class="gender-male">Jantan</span>
                                @else
                                    <span class="gender-female">Betina</span>
                                @endif
                            </td>
                            <td class="col-breed">{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                            <td class="col-owner">{{ $pet->pemilik->nama ?? '-' }}</td>
                            <td class="col-owner-id">{{ $pet->idpemilik }}</td>
                            <td class="col-action">
                                {{-- EDIT NAMA AKTIF: Admin bisa edit nama pet --}}
                                <div class="actions-inline">
                                    <a class="btn-edit" href="{{ route('admin.pet.edit', $pet->id) }}">Edit Nama</a>
                                    
                                    {{-- DELETE DISABLED: Hapus pet dinonaktifkan untuk admin --}}
                                    {{-- 
                                    <form method="POST" action="{{ route('admin.pet.destroy', $pet->id) }}" class="delete-form" onsubmit="return confirm('Yakin ingin menghapus pet ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                    --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="9">Belum ada data pet yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END MAIN CONTENT WRAPPER -->
        </div>
    </div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')