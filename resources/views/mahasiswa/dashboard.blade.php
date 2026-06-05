@extends('layouts.app')

@section('page_title', 'Dashboard Mahasiswa')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card glass-card border-0 text-white p-4 p-md-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
            <div class="position-absolute opacity-10" style="right: -5%; top: -20%;">
                <i class="bi bi-mortarboard-fill" style="font-size: 15rem;"></i>
            </div>
            <div class="position-relative z-1">
                <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold">Selamat Datang</span>
                <h3 class="fw-bolder mb-2 display-6">{{ auth()->user()->name }}</h3>
                <p class="mb-0 opacity-75 fs-5">Selesaikan proses unggah dokumen skripsi Anda di sini.</p>
            </div>
        </div>
    </div>
</div>

@if($skripsi)
<div class="row mb-4">
    <div class="col-12">
        @if($skripsi->status === 'sktl_pending')
            <div class="alert alert-info border-0 bg-info bg-opacity-10 text-info d-flex align-items-center rounded-4 shadow-sm p-4" role="alert">
                <i class="bi bi-hourglass-split fs-2 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1" style="font-size: 1.1rem;">SKTL Menunggu Verifikasi</strong>
                    <span>Dokumen Surat Keterangan Telah Lulus (SKTL) Anda sedang diperiksa oleh Operator. Harap tunggu proses verifikasi selesai.</span>
                </div>
                <div class="ms-3">
                    <a href="{{ route('mahasiswa.status') }}" class="btn btn-info text-white rounded-pill px-4 btn-sm fw-bold">Detail Status</a>
                </div>
            </div>
        @elseif($skripsi->status === 'sktl_rejected')
            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger d-flex align-items-center rounded-4 shadow-sm p-4" role="alert">
                <i class="bi bi-x-circle-fill fs-2 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1" style="font-size: 1.1rem;">SKTL Ditolak</strong>
                    <span>Dokumen SKTL Anda ditolak dengan alasan: <strong>{{ $skripsi->sktl_rejection_category }}</strong>. Catatan: {{ $skripsi->sktl_rejection_notes ?? 'Tidak ada catatan tambahan.' }}</span>
                </div>
                <div class="ms-3">
                    <a href="{{ route('mahasiswa.sktl.reupload') }}" class="btn btn-danger text-white rounded-pill px-4 btn-sm fw-bold">Upload Ulang</a>
                </div>
            </div>
        @elseif($skripsi->status === 'sktl_verified')
            <div class="alert alert-primary border-0 bg-primary bg-opacity-10 text-primary d-flex align-items-center rounded-4 shadow-sm p-4" role="alert">
                <i class="bi bi-patch-check-fill fs-2 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1" style="font-size: 1.1rem;">SKTL Berhasil Diverifikasi! 🎉</strong>
                    <span>Surat Keterangan Telah Lulus Anda telah disetujui. Langkah selanjutnya, silakan unggah berkas skripsi lengkap Anda.</span>
                </div>
                <div class="ms-3">
                    <a href="{{ route('mahasiswa.files.create') }}" class="btn btn-primary text-white rounded-pill px-4 btn-sm fw-bold">Upload File</a>
                </div>
            </div>
        @elseif($skripsi->status === 'files_pending')
            <div class="alert alert-info border-0 bg-info bg-opacity-10 text-info d-flex align-items-center rounded-4 shadow-sm p-4" role="alert">
                <i class="bi bi-hourglass-split fs-2 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1" style="font-size: 1.1rem;">Berkas Menunggu Verifikasi</strong>
                    <span>Berkas skripsi lengkap Anda telah diunggah dan sedang diperiksa oleh Operator. Anda akan diberi tahu jika ada perubahan status.</span>
                </div>
                <div class="ms-3">
                    <a href="{{ route('mahasiswa.status') }}" class="btn btn-info text-white rounded-pill px-4 btn-sm fw-bold">Detail Status</a>
                </div>
            </div>
        @elseif($skripsi->status === 'files_rejected')
            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger d-flex align-items-center rounded-4 shadow-sm p-4" role="alert">
                <i class="bi bi-x-circle-fill fs-2 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1" style="font-size: 1.1rem;">Berkas Skripsi Ditolak</strong>
                    <span>Dokumen berkas skripsi Anda ditolak karena: <strong>{{ $skripsi->file_rejection_category }}</strong>. Catatan: {{ $skripsi->file_rejection_notes ?? 'Tidak ada catatan tambahan.' }}</span>
                </div>
                <div class="ms-3">
                    <a href="{{ route('mahasiswa.files.reupload') }}" class="btn btn-danger text-white rounded-pill px-4 btn-sm fw-bold">Upload Ulang</a>
                </div>
            </div>
        @elseif($skripsi->status === 'files_verified')
            <div class="alert alert-warning border-0 bg-warning bg-opacity-10 text-warning d-flex align-items-center rounded-4 shadow-sm p-4" role="alert">
                <i class="bi bi-clock-history fs-2 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1" style="font-size: 1.1rem;">Menunggu Persetujuan Akhir</strong>
                    <span>Berkas skripsi Anda telah lolos verifikasi dari Operator dan saat ini menunggu persetujuan akhir serta publikasi dari Ketua Program Studi.</span>
                </div>
                <div class="ms-3">
                    <a href="{{ route('mahasiswa.status') }}" class="btn btn-warning text-dark rounded-pill px-4 btn-sm fw-bold">Detail Status</a>
                </div>
            </div>
        @elseif($skripsi->status === 'published')
            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success d-flex align-items-center rounded-4 shadow-sm p-4" role="alert">
                <i class="bi bi-stars fs-2 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1" style="font-size: 1.1rem;">Selamat! Skripsi Anda Telah Terpublikasi 🎉</strong>
                    <span>Karya ilmiah Anda telah disetujui oleh Kaprodi dan secara resmi masuk ke dalam repositori digital universitas.</span>
                </div>
                <div class="ms-3">
                    <a href="{{ route('skripsi.show', $skripsi->id) }}" class="btn btn-success text-white rounded-pill px-4 btn-sm fw-bold">Lihat Publikasi</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endif

<div class="row g-4">
    <div class="col-md-4">
        <div class="card glass-card border-0 p-4 h-100 text-center" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary" style="width: 70px; height: 70px;">
                    <i class="bi bi-1-circle-fill fs-1"></i>
                </div>
            </div>
            <h5 class="fw-bold text-dark">1. Upload SKTL</h5>
            <p class="text-muted small mb-4">Unggah Surat Keterangan Telah Lulus (SKTL) untuk diverifikasi oleh admin.</p>
            <a href="{{ route('mahasiswa.sktl.create') }}" class="btn btn-outline-primary rounded-pill w-100 fw-medium mt-auto">Mulai Upload</a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card glass-card border-0 p-4 h-100 text-center" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary" style="width: 70px; height: 70px;">
                    <i class="bi bi-2-circle-fill fs-1"></i>
                </div>
            </div>
            <h5 class="fw-bold text-dark">2. Upload File Skripsi</h5>
            <p class="text-muted small mb-4">Setelah SKTL disetujui, unggah file skripsi lengkap Anda (Cover, Abstrak, dll).</p>
            <a href="{{ route('mahasiswa.files.create') }}" class="btn btn-outline-primary rounded-pill w-100 fw-medium mt-auto">Lanjut Upload File</a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card glass-card border-0 p-4 h-100 text-center" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary" style="width: 70px; height: 70px;">
                    <i class="bi bi-activity fs-1"></i>
                </div>
            </div>
            <h5 class="fw-bold text-dark">3. Lacak Status</h5>
            <p class="text-muted small mb-4">Pantau terus perkembangan verifikasi dokumen Anda di menu status pengajuan.</p>
            <a href="{{ route('mahasiswa.status') }}" class="btn btn-primary-custom rounded-pill w-100 mt-auto">Cek Status Saya</a>
        </div>
    </div>
</div>
@endsection
