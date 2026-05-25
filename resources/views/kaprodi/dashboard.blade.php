@extends('layouts.app')

@section('page_title', 'Dashboard Kaprodi')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card glass-card border-0 text-white p-4 p-md-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
            <div class="position-absolute opacity-10" style="right: -5%; top: -20%;">
                <i class="bi bi-award-fill" style="font-size: 15rem;"></i>
            </div>
            <div class="position-relative z-1">
                <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold">Persetujuan Akhir</span>
                <h3 class="fw-bolder mb-2 display-6">Ketua Program Studi</h3>
                <p class="mb-0 opacity-75 fs-5">Pantau statistik dan setujui publikasi repositori mahasiswa.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card glass-card border-0 p-4 h-100 position-relative overflow-hidden" style="transition: all 0.2s;">
            <div class="position-absolute opacity-10" style="right: -10%; top: -10%;">
                <i class="bi bi-file-earmark-check-fill text-warning" style="font-size: 10rem;"></i>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="bg-warning bg-opacity-10 rounded-circle p-3 text-warning">
                    <i class="bi bi-file-earmark-check fs-2"></i>
                </div>
            </div>
            <div>
                <h6 class="text-muted fw-bold mb-2 text-uppercase" style="letter-spacing: 0.5px;">Perlu Persetujuan</h6>
                <h2 class="fw-bolder text-dark mb-0 display-5">{{ $pendingApproval }} <span class="fs-6 fw-bold text-muted text-uppercase">Dokumen</span></h2>
            </div>
            @if($pendingApproval > 0)
                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('kaprodi.persetujuan') }}" class="btn btn-warning w-100 fw-bold rounded-pill text-dark shadow-sm">Review Sekarang <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 p-4 h-100 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 16px; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);">
            <div class="position-absolute opacity-10" style="right: -10%; top: -10%;">
                <i class="bi bi-journal-bookmark-fill text-white" style="font-size: 10rem;"></i>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 text-white">
                    <i class="bi bi-journal-bookmark-fill fs-2"></i>
                </div>
            </div>
            <div class="position-relative z-1">
                <h6 class="text-white opacity-75 fw-bold mb-2 text-uppercase" style="letter-spacing: 0.5px;">Total Publikasi</h6>
                <h2 class="fw-bolder text-white mb-0 display-5">{{ $totalPublished }} <span class="fs-6 fw-bold opacity-75 text-uppercase">{{ (auth()->user()->jurusan->jenjang ?? 'S1') === 'S3' ? 'Disertasi' : ((auth()->user()->jurusan->jenjang ?? 'S1') === 'S2' ? 'Tesis' : 'Skripsi') }}</span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card glass-card border-0 p-4 h-100 position-relative overflow-hidden" style="transition: all 0.2s;">
            <div class="position-absolute opacity-10" style="right: -10%; top: -10%;">
                <i class="bi bi-bar-chart-fill text-primary" style="font-size: 10rem;"></i>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 rounded-circle p-3 text-primary">
                    <i class="bi bi-bar-chart-fill fs-2"></i>
                </div>
            </div>
            <div>
                <h6 class="text-muted fw-bold mb-2 text-uppercase" style="letter-spacing: 0.5px;">Total Pengajuan</h6>
                <h2 class="fw-bolder text-dark mb-0 display-5">{{ $totalSkripsi }} <span class="fs-6 fw-bold text-muted text-uppercase">Mahasiswa</span></h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card glass-card border-0 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark">Daftar Menunggu Persetujuan</h5>
            </div>
            
            @if($skripsis->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-check-circle-fill display-1 text-success opacity-25 mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">Antrean Kosong</h5>
                    <p class="text-muted">Tidak ada dokumen yang menunggu persetujuan saat ini.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0">
                        <thead class="text-muted small text-uppercase" style="background: #f9fafb;">
                            <tr>
                                <th class="ps-3 border-0 rounded-start-3 py-3">Mahasiswa</th>
                                <th class="border-0 py-3">Judul {{ (auth()->user()->jurusan->jenjang ?? 'S1') === 'S3' ? 'Disertasi' : ((auth()->user()->jurusan->jenjang ?? 'S1') === 'S2' ? 'Tesis' : 'Skripsi') }}</th>
                                <th class="border-0 py-3">Program Studi</th>
                                <th class="pe-3 border-0 rounded-end-3 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach($skripsis as $skripsi)
                            <tr>
                                <td class="ps-3 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($skripsi->user->name) }}&background=e5e7eb&color=374151&rounded=true" width="36" height="36" class="rounded-circle">
                                        <span class="fw-bold text-dark">{{ $skripsi->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="d-inline-block text-truncate fw-medium" style="max-width: 350px;">
                                        {{ $skripsi->title }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $skripsi->jurusan->name }}</span>
                                </td>
                                <td class="pe-3 py-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-medium" data-bs-toggle="modal" data-bs-target="#detailModal{{ $skripsi->id }}">
                                            <i class="bi bi-eye me-1"></i> Review
                                        </button>
                                        <form action="{{ route('kaprodi.approve', $skripsi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui dan mempublikasikan dokumen ini ke repositori?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm fw-medium">
                                                <i class="bi bi-check2-all me-1"></i> Approve
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Detail Modal (Omitted for brevity but assumed updated with nice styling) -->
                            <div class="modal fade" id="detailModal{{ $skripsi->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                                        <div class="modal-header border-0 bg-light p-4">
                                            <h5 class="modal-title fw-bold text-dark"><i class="bi bi-file-text text-primary me-2"></i> Review Dokumen {{ (auth()->user()->jurusan->jenjang ?? 'S1') === 'S3' ? 'Disertasi' : ((auth()->user()->jurusan->jenjang ?? 'S1') === 'S2' ? 'Tesis' : 'Skripsi') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 p-md-5">
                                            <div class="row mb-4">
                                                <div class="col-md-3 text-muted fw-semibold small text-uppercase">Judul</div>
                                                <div class="col-md-9 fw-bolder fs-5 text-dark">{{ $skripsi->title }}</div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-3 text-muted fw-semibold small text-uppercase">Penulis</div>
                                                <div class="col-md-9 fw-medium"><img src="https://ui-avatars.com/api/?name={{ urlencode($skripsi->user->name) }}&background=e5e7eb&color=374151&rounded=true" width="24" height="24" class="rounded-circle me-2"> {{ $skripsi->user->name }}</div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-3 text-muted fw-semibold small text-uppercase">Program Studi</div>
                                                <div class="col-md-9 fw-medium">{{ $skripsi->jurusan->name }}</div>
                                            </div>
                                            
                                            <div class="p-4 bg-light rounded-4 mt-5">
                                                <h6 class="fw-bold mb-3 d-flex align-items-center gap-2"><i class="bi bi-folder-check text-success"></i> File Dokumen (Telah Diverifikasi)</h6>
                                                <div class="d-flex flex-wrap gap-3">
                                                    <a href="{{ asset('storage/' . $skripsi->cover_file_path) }}" target="_blank" class="btn btn-outline-danger bg-white rounded-pill px-4"><i class="bi bi-file-pdf me-1"></i> Cover</a>
                                                    <a href="{{ asset('storage/' . $skripsi->abstrak_file_path) }}" target="_blank" class="btn btn-outline-danger bg-white rounded-pill px-4"><i class="bi bi-file-pdf me-1"></i> Abstrak</a>
                                                    <a href="{{ route('skripsi.download', $skripsi->id) }}#toolbar=0" target="_blank" class="btn btn-outline-danger bg-white rounded-pill px-4"><i class="bi bi-eye-fill me-1"></i> Lihat Full {{ $skripsi->sebutan }}</a>
                                                    <a href="{{ asset('storage/' . $skripsi->daftar_pustaka_file_path) }}" target="_blank" class="btn btn-outline-danger bg-white rounded-pill px-4"><i class="bi bi-file-pdf me-1"></i> Daftar Pustaka</a>
                                                    @if($skripsi->jurnal_file_path)
                                                        <a href="{{ asset('storage/' . $skripsi->jurnal_file_path) }}" target="_blank" class="btn btn-outline-info bg-white text-dark rounded-pill px-4"><i class="bi bi-journal me-1"></i> Jurnal</a>
                                                    @endif
                                                    @if($skripsi->turnitin_file_path)
                                                        <a href="{{ asset('storage/' . $skripsi->turnitin_file_path) }}" target="_blank" class="btn btn-outline-info bg-white text-dark rounded-pill px-4"><i class="bi bi-shield-check me-1"></i> Turnitin</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 bg-light p-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4 fw-medium" data-bs-dismiss="modal">Tutup</button>
                                            <form action="{{ route('kaprodi.approve', $skripsi->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success rounded-pill px-5 shadow-sm fw-bold">
                                                    <i class="bi bi-check-circle me-1"></i> Approve & Publikasi
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
