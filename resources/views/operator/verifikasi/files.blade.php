<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi File Skripsi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<div class="card card-custom border-0 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Antrean Verifikasi File Akhir</h5>
        <span class="badge bg-warning text-dark">0 Menunggu</span>
    </div>

    <div class="text-center py-5 text-muted">
        <i class="bi bi-check-circle display-4 mb-3 d-block text-success opacity-50"></i>
        <h6>Tidak ada antrean File saat ini.</h6>
    </div>

    <!-- Tabel (ditampilkan saat ada data dari backend) -->
    <div class="table-responsive d-none">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mahasiswa</th>
                    <th>Judul Karya Ilmiah</th>
                    <th>File yang Diunggah</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row contoh struktur -->
                <tr>
                    <td>
                        <div class="fw-bold">Nama Mahasiswa</div>
                        <div class="small text-muted">Nama Jurusan</div>
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 250px;" title="Judul Skripsi">
                            Judul Skripsi
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-1">
                            <a href="#" target="_blank" class="badge bg-danger text-decoration-none">Cover</a>
                            <a href="#" target="_blank" class="badge bg-danger text-decoration-none">Abstrak</a>
                            <a href="#" target="_blank" class="badge bg-danger text-decoration-none"><i class="bi bi-eye-fill"></i> Lihat Full Skripsi</a>
                            <a href="#" target="_blank" class="badge bg-danger text-decoration-none">Daftar Pustaka</a>
                            <a href="#" target="_blank" class="badge bg-info text-decoration-none text-dark">Jurnal Publikasi</a>
                            <a href="#" target="_blank" class="badge bg-info text-decoration-none text-dark">Hasil Turnitin</a>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm" onclick="return confirm('Setujui File ini?')">
                                    <i class="bi bi-check-lg me-1"></i> Terima
                                </button>
                            </form>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                <i class="bi bi-x-lg me-1"></i> Tolak
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 bg-danger text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-exclamation-triangle me-2"></i> Tolak File Skripsi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori Penolakan <span class="text-danger">*</span></label>
                        <select name="category" class="form-select bg-light border-0" required>
                            <option value="">-- Pilih Alasan --</option>
                            <option value="File tidak lengkap (Cover/Abstrak/Full/Dapus)">File tidak lengkap</option>
                            <option value="Format file tidak sesuai (bukan PDF / corrupted)">Format file tidak sesuai</option>
                            <option value="Terdeteksi indikasi plagiarisme di atas batas toleransi">Indikasi plagiarisme tinggi</option>
                            <option value="Halaman pengesahan belum di ttd lengkap">Halaman pengesahan belum lengkap</option>
                            <option value="Lainnya">Lainnya (Jelaskan di catatan)</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" class="form-control bg-light border-0" rows="3" placeholder="Tulis instruksi perbaikan file..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Tolak Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
