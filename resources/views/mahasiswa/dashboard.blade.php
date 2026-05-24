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
                <h3 class="fw-bolder mb-2 display-6">{{}}</h3>
                <p class="mb-0 opacity-75 fs-5">Selesaikan proses unggah dokumen skripsi Anda di sini.</p>
            </div>
        </div>
    </div>
</div>

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
            <a href="{{ }}" class="btn btn-outline-primary rounded-pill w-100 fw-medium mt-auto">Mulai Upload</a>
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
            <a href="{{ }}" class="btn btn-outline-primary rounded-pill w-100 fw-medium mt-auto">Lanjut Upload File</a>
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
            <a href="{{  }}" class="btn btn-primary-custom rounded-pill w-100 mt-auto">Cek Status Saya</a>
        </div>
    </div>
</div>
@endsection
