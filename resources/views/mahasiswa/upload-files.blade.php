@extends('layouts.app')

@section('page_title', 'Upload File Skripsi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card glass-card border-0 p-4">
            <h5 class="fw-bold mb-4">Upload Dokumen Skripsi Lengkap</h5>

            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-dark small mb-4">
                <i class="bi bi-check-circle me-1"></i> SKTL Anda telah diverifikasi. Silakan unggah file-file berikut untuk menyelesaikan pengajuan.
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">1. File Cover / Halaman Depan</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="cover_file" class="form-control form-control-sm mb-2" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">2. File Abstrak</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="abstrak_file" class="form-control form-control-sm mb-2" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">3. File Skripsi Lengkap (Bab 1 - 5)</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important; position: relative;">
                            <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2"><i class="bi bi-lock-fill"></i> Private</span>
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="skripsi_file" class="form-control form-control-sm mb-2" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Internal.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">4. File Daftar Pustaka</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="daftar_pustaka_file" class="form-control form-control-sm mb-2" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">5. Hasil Cek Plagiasi / Turnitin</label>
                        <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-2"></i>
                            <input type="file" name="turnitin_file" class="form-control form-control-sm mb-2" accept=".pdf" required>
                            <small class="text-muted d-block">Maks 20MB (.pdf). Akses Publik.</small>
                        </div>
                    </div>
                </div>

                <div class="form-check mb-4 bg-light p-3 border rounded-3 ms-0 ps-5">
                    <input class="form-check-input" type="checkbox" id="declarationFiles" required style="margin-left: -1.5em; margin-top: 0.3em;">
                    <label class="form-check-label small" for="declarationFiles">
                        <strong>Pernyataan Keaslian:</strong> Dengan mengunggah file-file ini, saya menyatakan bahwa skripsi ini adalah hasil karya saya sendiri, bebas dari plagiarisme, dan saya memberikan hak kepada Universitas Terbuka untuk menyimpannya dalam repositori institusi.
                    </label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="dashboard.blade.php" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary-custom px-4" id="submitFilesBtn" disabled>
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
