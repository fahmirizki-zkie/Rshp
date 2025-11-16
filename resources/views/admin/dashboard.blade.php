@include('layouts.admin.head')
@section('title', 'Dashboard Administrator')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/style_dashboard.css') }}">
@endpush

@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="dashboard-main">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard</h1>
        <a href="{{ route('admin.data-master') }}" class="btn-add">+ Akses Data Master</a>
    </div>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon blue">📄</div>
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ $total_users ?? 42 }}</div>
            <div class="stat-details">
                <span>{{ $total_users ?? 42 }} Pengguna</span>
                <span>Aktif</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon yellow">🔐</div>
            <div class="stat-label">Total Roles</div>
            <div class="stat-value">{{ $total_roles ?? 5 }}</div>
            <div class="stat-details">
                <span>{{ $total_roles ?? 5 }} Role</span>
                <span>Terdaftar</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">🐾</div>
            <div class="stat-label">Jenis Hewan</div>
            <div class="stat-value">{{ $total_jenis_hewan ?? 8 }}</div>
            <div class="stat-details">
                <span>{{ $total_jenis_hewan ?? 8 }} Jenis</span>
                <span>Data Master</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">🐕</div>
            <div class="stat-label">Ras Hewan</div>
            <div class="stat-value">{{ $total_ras_hewan ?? 24 }}</div>
            <div class="stat-details">
                <span>{{ $total_ras_hewan ?? 24 }} Ras</span>
                <span>Terdaftar</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Recent Activities -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Aktivitas Terbaru Sistem</h2>
                <a href="#" class="link-more">Lihat semua</a>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Aktivitas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="file-info">
                                    <div class="file-icon" style="background: #fef3c7;">📋</div>
                                    <span>Registrasi Pasien Baru</span>
                                </div>
                            </td>
                            <td>{{ now()->subDays(0)->format('d-m-Y') }}</td>
                            <td><span style="color: #10b981;">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="file-info">
                                    <div class="file-icon" style="background: #dbeafe;">💉</div>
                                    <span>Pemeriksaan Klinis</span>
                                </div>
                            </td>
                            <td>{{ now()->subDays(1)->format('d-m-Y') }}</td>
                            <td><span style="color: #f59e0b;">Proses</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="file-info">
                                    <div class="file-icon" style="background: #ede9fe;">📊</div>
                                    <span>Update Data Master</span>
                                </div>
                            </td>
                            <td>{{ now()->subDays(2)->format('d-m-Y') }}</td>
                            <td><span style="color: #10b981;">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="file-info">
                                    <div class="file-icon" style="background: #d1fae5;">👤</div>
                                    <span>Tambah User Baru</span>
                                </div>
                            </td>
                            <td>{{ now()->subDays(3)->format('d-m-Y') }}</td>
                            <td><span style="color: #10b981;">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="file-info">
                                    <div class="file-icon" style="background: #fee2e2;">🔧</div>
                                    <span>Maintenance Sistem</span>
                                </div>
                            </td>
                            <td>{{ now()->subDays(4)->format('d-m-Y') }}</td>
                            <td><span style="color: #6b7280;">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Statistics Summary -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Statistik Data Master</h2>
            </div>
            <div class="storage-widget">
                <div class="storage-chart">
                    <svg viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="80" fill="none" stroke="#e5e7eb" stroke-width="20"/>
                        <circle cx="100" cy="100" r="80" fill="none" stroke="#3b82f6" stroke-width="20" 
                                stroke-dasharray="502" stroke-dashoffset="100" class="storage-circle"/>
                        <circle cx="100" cy="100" r="80" fill="none" stroke="#10b981" stroke-width="20" 
                                stroke-dasharray="502" stroke-dashoffset="250" class="storage-circle"/>
                        <circle cx="100" cy="100" r="80" fill="none" stroke="#fbbf24" stroke-width="20" 
                                stroke-dasharray="502" stroke-dashoffset="350" class="storage-circle"/>
                    </svg>
                    <div class="storage-info">
                        <div class="storage-used">{{ ($total_users ?? 42) + ($total_roles ?? 5) + ($total_jenis_hewan ?? 8) + ($total_ras_hewan ?? 24) }}</div>
                        <div class="storage-total">Total Data</div>
                    </div>
                </div>

                <div class="storage-files">
                    <div class="storage-item">
                        <div class="storage-item-info">
                            <div class="storage-item-icon" style="background: #dbeafe;">👥</div>
                            <div>
                                <div style="font-weight: 500;">Total Users</div>
                                <div class="storage-item-count">Pengguna Sistem</div>
                            </div>
                        </div>
                        <div class="storage-item-size">{{ $total_users ?? 42 }}</div>
                    </div>

                    <div class="storage-item">
                        <div class="storage-item-info">
                            <div class="storage-item-icon" style="background: #d1fae5;">🛡️</div>
                            <div>
                                <div style="font-weight: 500;">Total Roles</div>
                                <div class="storage-item-count">Role Akses</div>
                            </div>
                        </div>
                        <div class="storage-item-size">{{ $total_roles ?? 5 }}</div>
                    </div>

                    <div class="storage-item">
                        <div class="storage-item-info">
                            <div class="storage-item-icon" style="background: #fef3c7;">🐾</div>
                            <div>
                                <div style="font-weight: 500;">Jenis Hewan</div>
                                <div class="storage-item-count">Kategori Hewan</div>
                            </div>
                        </div>
                        <div class="storage-item-size">{{ $total_jenis_hewan ?? 8 }}</div>
                    </div>

                    <div class="storage-item">
                        <div class="storage-item-info">
                            <div class="storage-item-icon" style="background: #ede9fe;">🐕</div>
                            <div>
                                <div style="font-weight: 500;">Ras Hewan</div>
                                <div class="storage-item-count">Data Ras</div>
                            </div>
                        </div>
                        <div class="storage-item-size">{{ $total_ras_hewan ?? 24 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
