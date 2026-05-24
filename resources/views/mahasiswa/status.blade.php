@extends('layouts.app')

@section('page_title', 'Status Pengajuan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card glass-card border-0 p-4">
            <h5 class="fw-bold mb-4">Riwayat & Status Pengajuan</h5>

            <div class="mb-5">
                <h6 class="fw-bold text-muted mb-3">Informasi Skripsi</h6>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">Judul</td>
                        <td class="fw-semibold">Analisis Sistem Informasi Akademik Berbasis Web</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jurusan</td>
                        <td class="fw-semibold">Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Fakultas</td>
                        <td class="fw-semibold">Fakultas Sains dan Teknologi</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Terakhir Update</td>
                        <td class="fw-semibold">20 Mei 2026, 10:30</td>
                    </tr>
                </table>
            </div>

            <div class="position-relative ms-4 border-start border-2 pb-2">

                <!-- Step 1: Upload SKTL -->
                <div class="mb-4 position-relative">
                    <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-success" style="width: 32px; height: 32px; left: -17px; top: 0;">
                        <i class="bi bi-check text-success fs-5"></i>
                    </div>
                    <div class="ms-4 ps-2">
                        <h6 class="fw-bold mb-1">Upload SKTL</h6>
                        <p class="small text-muted mb-0">File SKTL berhasil diunggah pada 15 Mei 2026.</p>
                    </div>
                </div>

                <!-- Step 2: Verifikasi SKTL -->
                <div class="mb-4 position-relative">
                    <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-success" style="width: 32px; height: 32px; left: -17px; top: 0;">
                        <i class="bi bi-check text-success fs-5"></i>
                    </div>
                    <div class="ms-4 ps-2">
                        <h6 class="fw-bold mb-1 text-success">Verifikasi SKTL</h6>
                        <p class="small text-success mb-0">SKTL disetujui.</p>
                    </div>
                </div>

                <!-- Step 3: Upload File -->
                <div class="mb-4 position-relative">
                    <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-primary" style="width: 32px; height: 32px; left: -17px; top: 0;">
                        <i class="bi bi-hourglass-split text-primary"></i>
                    </div>
                    <div class="ms-4 ps-2">
                        <h6 class="fw-bold mb-1 text-primary">Upload File Skripsi Lengkap</h6>
                        <p class="small text-muted mb-1">Anda perlu mengunggah 4 file skripsi.</p>
                        <a href="upload-files.blade.php" class="btn btn-sm btn-primary rounded-pill py-0">Upload Sekarang</a>
                    </div>
                </div>

                <!-- Step 4: Verifikasi File -->
                <div class="mb-4 position-relative">
                    <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-secondary" style="width: 32px; height: 32px; left: -17px; top: 0;">
                        <i class="bi bi-circle text-secondary"></i>
                    </div>
                    <div class="ms-4 ps-2">
                        <h6 class="fw-bold mb-1 text-secondary">Verifikasi File & Plagiarisme</h6>
                        <p class="small text-muted mb-0">Menunggu upload file.</p>
                    </div>
                </div>

                <!-- Step 5: Publikasi -->
                <div class="position-relative">
                    <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-secondary" style="width: 32px; height: 32px; left: -17px; top: 0;">
                        <i class="bi bi-circle text-secondary"></i>
                    </div>
                    <div class="ms-4 ps-2">
                        <h6 class="fw-bold mb-1 text-secondary">Persetujuan Kaprodi & Publikasi</h6>
                        <p class="small text-muted mb-0">Belum mencapai tahap ini.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
