@extends('layouts.app')

@section('page_title', 'Persetujuan Akhir Skripsi')

@section('content')
<div class="card glass-card border-0 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Antrean Persetujuan Dokumen Skripsi</h5>
        <span class="badge bg-warning text-dark">5 Menunggu</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mahasiswa</th>
                    <th>Judul Karya Ilmiah</th>
                    <th>File Publik</th>
                    <th>File Internal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <!-- Baris contoh 1 -->
                <tr>
                    <td>
                        <div class="fw-bold">Andi Pratama</div>
                        <div class="small text-muted">Sistem Informasi</div>
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 250px;" title="Implementasi Machine Learning untuk Prediksi Nilai Mahasiswa">
                            Implementasi Machine Learning untuk Prediksi Nilai Mahasiswa
                        </div>
                    </td>
                    <td>
                        <a href="#" class="badge bg-danger text-decoration-none">Cover</a>
                        <a href="#" class="badge bg-danger text-decoration-none">Abstrak</a>
                        <a href="#" class="badge bg-danger text-decoration-none">Daftar Pustaka</a>
                        <a href="#" class="badge bg-info text-decoration-none text-dark">Turnitin</a>
                    </td>
                    <td>
                        <a href="#" class="badge bg-danger text-decoration-none"><i class="bi bi-eye-fill"></i> Lihat Full Skripsi</a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> Approve
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Baris contoh 2 -->
                <tr>
                    <td>
                        <div class="fw-bold">Siti Rahayu</div>
                        <div class="small text-muted">Ilmu Komputer</div>
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 250px;" title="Rancang Bangun Aplikasi Perpustakaan Digital Universitas">
                            Rancang Bangun Aplikasi Perpustakaan Digital Universitas
                        </div>
                    </td>
                    <td>
                        <a href="#" class="badge bg-danger text-decoration-none">Cover</a>
                        <a href="#" class="badge bg-danger text-decoration-none">Abstrak</a>
                        <a href="#" class="badge bg-danger text-decoration-none">Daftar Pustaka</a>
                    </td>
                    <td>
                        <a href="#" class="badge bg-danger text-decoration-none"><i class="bi bi-eye-fill"></i> Lihat Full Skripsi</a>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> Approve
                            </button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endsection
