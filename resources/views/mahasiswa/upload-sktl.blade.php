@extends('layouts.app')

@section('page_title', 'Upload SKTL')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card glass-card border-0 p-4">
            <h5 class="fw-bold mb-4">Formulir Upload SKTL</h5>

            <div class="alert alert-info border-0 bg-light small mb-4">
                <i class="bi bi-info-circle me-1"></i> SKTL (Surat Keterangan Telah Lulus) adalah syarat utama sebelum mengunggah file skripsi. Pastikan data sesuai.
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Skripsi</label>
                    <textarea name="title" class="form-control" rows="2">Analisis Sistem Informasi Akademik Berbasis Web</textarea>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label fw-semibold">Fakultas</label>
                        <input type="text" class="form-control bg-light border-0" value="Fakultas Sains dan Teknologi" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Program Studi / Jurusan</label>
                        <input type="text" class="form-control bg-light border-0" value="Sistem Informasi" readonly>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">File SKTL (PDF, Max 20MB)</label>
                    <div class="border rounded-3 p-4 text-center bg-light" style="border-style: dashed !important;">
                        <i class="bi bi-cloud-arrow-up display-4 text-secondary mb-3"></i>
                        <input type="file" name="sktl_file" class="form-control mb-2" accept=".pdf" required>
                        <small class="text-muted">Hanya menerima file berformat .pdf</small>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="declaration" required>
                    <label class="form-check-label small text-muted" for="declaration">
                        Saya menyatakan bahwa dokumen yang diunggah adalah benar dan dapat dipertanggungjawabkan keasliannya.
                    </label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="dashboard.blade.php" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary-custom px-4" id="submitBtn" disabled>
                        <i class="bi bi-send me-1"></i> Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const declarationCheckbox = document.getElementById('declaration');
        const submitBtn = document.getElementById('submitBtn');

        declarationCheckbox.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });
    });
</script>
@endsection
