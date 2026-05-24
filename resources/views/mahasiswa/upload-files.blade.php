@extends('layouts.app')

@section('page_title', 'Upload File Skripsi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-custom border-0 p-4">
            <h5 class="fw-bold mb-4">Upload Dokumen {{ auth()->user()->skripsi->sebutan ?? 'Tugas Akhir' }} Lengkap</h5>
            
            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-dark small mb-4">
                <i class="bi bi-check-circle me-1"></i> SKTL Anda telah diverifikasi. Silakan unggah file-file berikut untuk menyelesaikan pengajuan.
            </div>

            <form action="{{ request()->routeIs('mahasiswa.files.reupload') ? route('mahasiswa.files.storeReupload') : route('mahasiswa.files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">1. File Cover / Halaman Depan</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="cover_file" class="form-control form-control-sm mb-2 @error('cover_file') is-invalid @enderror" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                            @error('cover_file') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">2. File Abstrak</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="abstrak_file" class="form-control form-control-sm mb-2 @error('abstrak_file') is-invalid @enderror" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                            @error('abstrak_file') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">3. File {{ auth()->user()->skripsi->sebutan ?? 'Skripsi' }} Lengkap (Bab 1 - 5)</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important; position: relative;">
                            <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2"><i class="bi bi-lock-fill"></i> Private</span>
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="skripsi_file" class="form-control form-control-sm mb-2 @error('skripsi_file') is-invalid @enderror" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Internal.</small>
                            @error('skripsi_file') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">4. File Daftar Pustaka</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="daftar_pustaka_file" class="form-control form-control-sm mb-2 @error('daftar_pustaka_file') is-invalid @enderror" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                            @error('daftar_pustaka_file') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">5. Hasil Cek Plagiasi / Turnitin</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="turnitin_file" class="form-control form-control-sm mb-2 @error('turnitin_file') is-invalid @enderror" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                            @error('turnitin_file') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    @if(auth()->user()->jurusan && in_array(auth()->user()->jurusan->jenjang, ['S2', 'S3']))
                    @php
                        $isS3 = auth()->user()->jurusan->jenjang === 'S3';
                    @endphp
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            6. Bukti Publikasi Jurnal 
                            @if($isS3)
                                <span class="badge bg-danger ms-1">Internasional (Scopus/WoS)</span>
                            @else
                                <span class="badge bg-info ms-1">Nasional (Sinta)</span>
                            @endif
                        </label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="jurnal_file" class="form-control form-control-sm mb-2 @error('jurnal_file') is-invalid @enderror" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                            @error('jurnal_file') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    @endif
                </div>

                <div class="form-check mb-4 bg-light p-3 border rounded-3 ms-0 ps-5">
                    <input class="form-check-input" type="checkbox" id="declarationFiles" required style="margin-left: -1.5em; margin-top: 0.3em;">
                    <label class="form-check-label small" for="declarationFiles">
                        <strong>Pernyataan Keaslian:</strong> Dengan mengunggah file-file ini, saya menyatakan bahwa {{ strtolower(auth()->user()->skripsi->sebutan ?? 'tugas akhir') }} ini adalah hasil karya saya sendiri, bebas dari plagiarisme, dan saya memberikan hak kepada Universitas Terbuka untuk menyimpannya dalam repositori institusi.
                    </label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary-green px-4" id="submitFilesBtn" disabled>
                        <i class="bi bi-cloud-upload me-1"></i> Mulai Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const declarationCheckbox = document.getElementById('declarationFiles');
        const submitBtn = document.getElementById('submitFilesBtn');

        declarationCheckbox.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });
    });
</script>
@endsection
