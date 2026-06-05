@extends('layouts.app')

@section('page_title', 'Detail Dokumen')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('welcome') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left me-1"></i> Kembali ke Pencarian</a>
    </div>

    <div class="card card-custom border-0 p-5 mb-5 shadow-sm">
        <div class="row">
            <div class="col-md-8 border-end pe-5">
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-3 px-3 py-2 fw-semibold">{{ $skripsi->jurusan->name }}</span>
                <h2 class="fw-bold text-dark mb-4">{{ $skripsi->title }}</h2>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-light rounded-circle p-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-badge fs-4 text-secondary"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted small fw-bold text-uppercase">Penulis</p>
                        <h5 class="mb-0 fw-semibold">{{ $skripsi->user->name }}</h5>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <p class="mb-1 text-muted small fw-bold text-uppercase">Fakultas</p>
                            <p class="mb-0 fw-medium">{{ $skripsi->jurusan->fakultas->name }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <p class="mb-1 text-muted small fw-bold text-uppercase">Tanggal Terbit</p>
                            <p class="mb-0 fw-medium">{{ $skripsi->updated_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 ps-5 d-flex flex-column justify-content-center">
                <div class="text-center mb-4">
                    <div class="display-1 text-success mb-2"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold">Dokumen Terverifikasi</h5>
                    <p class="text-muted small">Telah disetujui oleh Program Studi.</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="fw-bold mb-4">File Tersedia</h4>
    <div class="row g-4">
        <!-- Cover -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 border text-center p-4 hover-lift">
                <div class="fs-1 text-danger mb-3"><i class="bi bi-file-earmark-pdf"></i></div>
                <h6 class="fw-bold mb-3">Halaman Sampul</h6>
                <div class="mt-auto">
                    @if($skripsi->cover_file_path)
                        @if(auth()->check())
                            <a href="{{ asset('storage/' . $skripsi->cover_file_path) }}" target="_blank" class="btn btn-outline-success w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @else
                            <a href="{{ asset('storage/' . $skripsi->cover_file_path) }}#toolbar=0" target="_blank" class="btn btn-outline-primary w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @endif
                    @else
                        <span class="text-muted small">Tidak tersedia</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Abstrak -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 border text-center p-4 hover-lift">
                <div class="fs-1 text-danger mb-3"><i class="bi bi-file-earmark-pdf"></i></div>
                <h6 class="fw-bold mb-3">Abstrak</h6>
                <div class="mt-auto">
                    @if($skripsi->abstrak_file_path)
                        @if(auth()->check())
                            <a href="{{ asset('storage/' . $skripsi->abstrak_file_path) }}" target="_blank" class="btn btn-outline-success w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @else
                            <a href="{{ asset('storage/' . $skripsi->abstrak_file_path) }}#toolbar=0" target="_blank" class="btn btn-outline-primary w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @endif
                    @else
                        <span class="text-muted small">Tidak tersedia</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bab 1-5 -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 border text-center p-4 hover-lift {{ !auth()->check() ? 'bg-light' : '' }}">
                <div class="fs-1 text-danger mb-3 position-relative">
                    <i class="bi bi-file-earmark-pdf"></i>
                    @if(!auth()->check())
                        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-warning text-dark" style="font-size: 0.5rem;"><i class="bi bi-lock-fill"></i> LOGIN</span>
                    @endif
                </div>
                <h6 class="fw-bold mb-3">Dokumen Lengkap<br><small class="text-muted fw-normal">(Bab 1 - 5)</small></h6>
                <div class="mt-auto">
                    @if($skripsi->skripsi_file_path)
                        @if(auth()->check())
                            @if(auth()->id() == $skripsi->user_id || auth()->user()->isOperator() || auth()->user()->isKaprodi())
                                <a href="{{ route('skripsi.download', $skripsi->id) }}" target="_blank" class="btn btn-success w-100 rounded-pill shadow-sm"><i class="bi bi-eye me-1"></i> Lihat Dokumen</a>
                            @else
                                <a href="{{ route('skripsi.download', $skripsi->id) }}#toolbar=0" target="_blank" class="btn btn-outline-success w-100 rounded-pill shadow-sm"><i class="bi bi-eye me-1"></i> Baca Dokumen</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-warning w-100 rounded-pill fw-bold text-dark"><i class="bi bi-box-arrow-in-right me-1"></i> Login Akses</a>
                        @endif
                    @else
                        <span class="text-muted small">Tidak tersedia</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Daftar Pustaka -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 border text-center p-4 hover-lift">
                <div class="fs-1 text-danger mb-3"><i class="bi bi-file-earmark-pdf"></i></div>
                <h6 class="fw-bold mb-3">Daftar Pustaka</h6>
                <div class="mt-auto">
                    @if($skripsi->daftar_pustaka_file_path)
                        @if(auth()->check())
                            <a href="{{ asset('storage/' . $skripsi->daftar_pustaka_file_path) }}" target="_blank" class="btn btn-outline-success w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @else
                            <a href="{{ asset('storage/' . $skripsi->daftar_pustaka_file_path) }}#toolbar=0" target="_blank" class="btn btn-outline-primary w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @endif
                    @else
                        <span class="text-muted small">Tidak tersedia</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Turnitin -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 border text-center p-4 hover-lift">
                <div class="fs-1 text-danger mb-3"><i class="bi bi-shield-check"></i></div>
                <h6 class="fw-bold mb-3">Hasil Cek Turnitin</h6>
                <div class="mt-auto">
                    @if($skripsi->turnitin_file_path)
                        @if(auth()->check())
                            <a href="{{ asset('storage/' . $skripsi->turnitin_file_path) }}" target="_blank" class="btn btn-outline-success w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @else
                            <a href="{{ asset('storage/' . $skripsi->turnitin_file_path) }}#toolbar=0" target="_blank" class="btn btn-outline-primary w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                        @endif
                    @else
                        <span class="text-muted small">Tidak tersedia</span>
                    @endif
                </div>
            </div>
        </div>

        @if(in_array($skripsi->jurusan->jenjang ?? 'S1', ['S2', 'S3']) && $skripsi->jurnal_file_path)
        <!-- Tambahan -->
        <div class="col-12 mt-4 pt-3 border-top">
            <h5 class="fw-bold mb-4 text-muted"><i class="bi bi-journal-bookmark-fill me-2"></i>Bukti Publikasi Jurnal (S2/S3)</h5>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card card-custom h-100 border text-center p-4 hover-lift">
                        <div class="fs-1 text-info mb-3"><i class="bi bi-file-earmark-pdf"></i></div>
                        <h6 class="fw-bold mb-3">Bukti Jurnal Publikasi</h6>
                        <div class="mt-auto">
                            @if(auth()->check())
                                <a href="{{ asset('storage/' . $skripsi->jurnal_file_path) }}" target="_blank" class="btn btn-outline-info text-dark w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                            @else
                                <a href="{{ asset('storage/' . $skripsi->jurnal_file_path) }}#toolbar=0" target="_blank" class="btn btn-outline-info text-dark w-100 rounded-pill"><i class="bi bi-eye me-1"></i> Lihat</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05) !important;
    }
</style>
@endsection
