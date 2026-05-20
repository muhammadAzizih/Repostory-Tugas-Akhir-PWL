@extends('layouts.app')

@section('page_title', 'Dashboard Operator')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card glass-card border-0 text-white p-4 p-md-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
            <div class="position-absolute opacity-10" style="right: -5%; top: -20%;">
                <i class="bi bi-shield-lock-fill" style="font-size: 15rem;"></i>
            </div>
            <div class="position-relative z-1">
                <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold">Panel Admin</span>
                <h3 class="fw-bolder mb-2 display-6">Halo, Operator</h3>
                <p class="mb-0 opacity-75 fs-5">Kelola verifikasi dan data repositori mahasiswa hari ini.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- Bento Grid Style -->
    <div class="col-md-3">
        <div class="card glass-card border-0 p-4 h-100 text-center" style="transition: all 0.2s;">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-file-earmark-arrow-up fs-2"></i>
            </div>
            <h2 class="fw-bolder text-dark mb-1 display-5">0</h2>
            <p class="text-muted fw-semibold mb-0 small text-uppercase" style="letter-spacing: 0.5px;">SKTL Pending</p>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card glass-card border-0 p-4 h-100 text-center" style="transition: all 0.2s;">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-files fs-2"></i>
            </div>
            <h2 class="fw-bolder text-dark mb-1 display-5">0</h2>
            <p class="text-muted fw-semibold mb-0 small text-uppercase" style="letter-spacing: 0.5px;">File Pending</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card glass-card border-0 p-4 h-100 text-center" style="transition: all 0.2s;">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-check-circle-fill fs-2"></i>
            </div>
            <h2 class="fw-bolder text-dark mb-1 display-5">0</h2>
            <p class="text-muted fw-semibold mb-0 small text-uppercase" style="letter-spacing: 0.5px;">Telah Diverifikasi</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 p-4 h-100 text-center text-white" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 16px; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25 text-white mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-journal-check fs-2"></i>
            </div>
            <h2 class="fw-bolder mb-1 display-5 text-white">0</h2>
            <p class="text-white opacity-75 fw-semibold mb-0 small text-uppercase" style="letter-spacing: 0.5px;">Total Publikasi</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card glass-card border-0 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark">Aktivitas Pengajuan Terbaru</h5>
                <a href="{{}}" class="btn btn-sm btn-light rounded-pill px-3 fw-medium">Lihat Semua</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0">
                    <thead class="text-muted small text-uppercase" style="background: #f9fafb;">
                        <tr>
                            <th class="ps-3 border-0 rounded-start-3 py-3">Mahasiswa</th>
                            <th class="border-0 py-3">Judul </th>
                            <th class="border-0 py-3">Status</th>
                            <th class="pe-3 border-0 rounded-end-3 py-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse()
                        <tr>
                            <td class="ps-3 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name&background=e5e7eb&color=374151&rounded=true" width="36" height="36" class="rounded-circle">
                                    <span class="fw-bold text-dark">Nama</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="d-inline-block text-truncate text-muted fw-medium" style="max-width: 300px;">
                                    Judul
                                </span>
                            </td>
                            <td class="py-3">
                                @if()
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-hourglass me-1"></i> SKTL Pending</span>
                                @elseif()
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-hourglass me-1"></i> File Pending</span>
                                @elseif()
                                    <span class="badge bg-success px-3 py-2 rounded-pill"><i class="bi bi-check-circle me-1"></i> Published</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ }}</span>
                                @endif
                            </td>
                            <td class="pe-3 py-3 text-muted small fw-medium">{{}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                                Belum ada data pengajuan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
