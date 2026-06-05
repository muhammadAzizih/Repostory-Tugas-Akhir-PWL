@extends('layouts.app')

@section('page_title', 'Detail Pengajuan')

@section('content')
<style>
    .detail-header { background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0f9ff 100%); border-radius: 16px; padding: 2rem; }
    .status-timeline { position: relative; padding-left: 2rem; }
    .status-timeline::before { content: ''; position: absolute; left: 10px; top: 12px; bottom: 12px; width: 2px; background: #e5e7eb; }
    .timeline-step { position: relative; padding-bottom: 3rem; }
    .timeline-step:last-child { padding-bottom: 0; }
    .timeline-dot { position: absolute; left: -1.65rem; top: 6px; width: 16px; height: 16px; border-radius: 50%; border: 3px solid #e5e7eb; background: #fff; z-index: 1; }
    .timeline-dot.active { border-color: var(--primary); background: var(--primary); }
    .timeline-dot.rejected { border-color: #ef4444; background: #ef4444; }
    .timeline-dot.pending { border-color: #f59e0b; background: #f59e0b; animation: pulse-dot 1.5s infinite; }
    @keyframes pulse-dot { 0%, 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); } 50% { box-shadow: 0 0 0 8px rgba(245, 158, 11, 0); } }
    .file-card { transition: transform 0.2s ease, box-shadow 0.2s ease; border-radius: 12px; }
    .file-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important; }
    .rejection-box { background: linear-gradient(135deg, #fef2f2, #fff1f2); border: 1px solid #fecaca; border-radius: 12px; padding: 1.25rem; }
</style>

<div class="container-fluid">
    {{-- Header --}}
    <div class="detail-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                @php
                    $statusBadges = [
                        'draft' => ['bg' => 'secondary', 'icon' => 'bi-pencil', 'label' => 'Draf Awal'],
                        'sktl_pending' => ['bg' => 'warning text-dark', 'icon' => 'bi-hourglass-split', 'label' => 'Menunggu Verifikasi SKTL'],
                        'sktl_verified' => ['bg' => 'primary', 'icon' => 'bi-check-circle', 'label' => 'SKTL Terverifikasi'],
                        'sktl_rejected' => ['bg' => 'danger', 'icon' => 'bi-x-circle', 'label' => 'SKTL Ditolak'],
                        'files_pending' => ['bg' => 'warning text-dark', 'icon' => 'bi-hourglass-split', 'label' => 'Menunggu Verifikasi Berkas'],
                        'files_verified' => ['bg' => 'info text-dark', 'icon' => 'bi-clock', 'label' => 'Menunggu Persetujuan Kaprodi'],
                        'files_rejected' => ['bg' => 'danger', 'icon' => 'bi-x-circle', 'label' => 'Berkas Ditolak'],
                        'approved' => ['bg' => 'success', 'icon' => 'bi-check-all', 'label' => 'Disetujui Kaprodi'],
                        'published' => ['bg' => 'success', 'icon' => 'bi-globe', 'label' => 'Terpublikasi'],
                    ];
                    $badge = $statusBadges[$skripsi->status] ?? ['bg' => 'secondary', 'icon' => 'bi-question-circle', 'label' => 'Tidak Diketahui'];
                @endphp
                <span class="badge bg-{{ $badge['bg'] }} rounded-pill px-3 py-2 fw-semibold mb-3" style="font-size: 0.85rem;">
                    <i class="bi {{ $badge['icon'] }} me-1"></i> {{ $badge['label'] }}
                </span>
                <h3 class="fw-bold text-dark mb-2">{{ $skripsi->title }}</h3>
                <p class="text-muted mb-0">{{ $skripsi->jurusan->name ?? '-' }} &bull; {{ $skripsi->jurusan->fakultas->name ?? '-' }}</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="text-muted small">Terakhir diupdate</div>
                <div class="fw-semibold">{{ $skripsi->updated_at->translatedFormat('d F Y, H:i') }} WIB</div>
                <div class="text-muted small mt-2">Dibuat pada</div>
                <div class="fw-semibold">{{ $skripsi->created_at->translatedFormat('d F Y, H:i') }} WIB</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column: Info & Files --}}
        <div class="col-lg-8">
            {{-- Student Info --}}
            <div class="card card-custom border-0 p-4 mb-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-person-badge me-2 text-primary"></i>Informasi Mahasiswa</h6>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <p class="mb-1 text-muted small fw-bold text-uppercase">Nama Lengkap</p>
                            <p class="mb-0 fw-medium">{{ $skripsi->user->name }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <p class="mb-1 text-muted small fw-bold text-uppercase">Email</p>
                            <p class="mb-0 fw-medium">{{ $skripsi->user->email }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <p class="mb-1 text-muted small fw-bold text-uppercase">Program Studi</p>
                            <p class="mb-0 fw-medium">{{ $skripsi->jurusan->name ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <p class="mb-1 text-muted small fw-bold text-uppercase">Fakultas</p>
                            <p class="mb-0 fw-medium">{{ $skripsi->jurusan->fakultas->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SKTL Rejection Info --}}
            @if($skripsi->status === 'sktl_rejected' && $skripsi->sktl_rejection_notes)
            <div class="rejection-box mb-4">
                <h6 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Alasan Penolakan SKTL</h6>
                @if($skripsi->sktl_rejection_category)
                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1 mb-2 d-inline-block">{{ $skripsi->sktl_rejection_category }}</span>
                @endif
                <p class="mb-0 text-dark">{{ $skripsi->sktl_rejection_notes }}</p>
            </div>
            @endif

            {{-- File Rejection Info --}}
            @if($skripsi->status === 'files_rejected' && $skripsi->file_rejection_notes)
            <div class="rejection-box mb-4">
                <h6 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Alasan Penolakan Berkas</h6>
                @if($skripsi->file_rejection_category)
                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1 mb-2 d-inline-block">{{ $skripsi->file_rejection_category }}</span>
                @endif
                <p class="mb-0 text-dark">{{ $skripsi->file_rejection_notes }}</p>
            </div>
            @endif

            {{-- Uploaded Files --}}
            <div class="card card-custom border-0 p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-folder2-open me-2 text-primary"></i>Dokumen yang Diupload</h6>
                <div class="row g-3">
                    @php
                        $jenjang = $skripsi->jurusan->jenjang ?? 'S1';
                        $files = [
                            ['label' => 'SKTL', 'path' => $skripsi->sktl_file_path, 'icon' => 'bi-file-earmark-check', 'color' => 'text-success'],
                            ['label' => 'Halaman Sampul', 'path' => $skripsi->cover_file_path, 'icon' => 'bi-file-earmark-pdf', 'color' => 'text-danger'],
                            ['label' => 'Abstrak', 'path' => $skripsi->abstrak_file_path, 'icon' => 'bi-file-earmark-pdf', 'color' => 'text-danger'],
                            ['label' => 'Dokumen Lengkap (Bab 1-5)', 'path' => $skripsi->skripsi_file_path, 'icon' => 'bi-file-earmark-pdf', 'color' => 'text-danger'],
                            ['label' => 'Daftar Pustaka', 'path' => $skripsi->daftar_pustaka_file_path, 'icon' => 'bi-file-earmark-pdf', 'color' => 'text-danger'],
                            ['label' => 'Hasil Turnitin', 'path' => $skripsi->turnitin_file_path, 'icon' => 'bi-shield-check', 'color' => 'text-info'],
                        ];
                        if (in_array($jenjang, ['S2', 'S3'])) {
                            $files[] = ['label' => 'Bukti Jurnal (S2/S3)', 'path' => $skripsi->jurnal_file_path, 'icon' => 'bi-journal-bookmark', 'color' => 'text-info'];
                        }
                    @endphp

                    @foreach($files as $file)
                    <div class="col-sm-6 col-lg-4">
                        <div class="card file-card h-100 border text-center p-3">
                            <div class="fs-2 {{ $file['color'] }} mb-2"><i class="bi {{ $file['icon'] }}"></i></div>
                            <h6 class="fw-bold small mb-2">{{ $file['label'] }}</h6>
                            @if($file['path'])
                                @php
                                    $url = asset('storage/' . $file['path']);
                                    if ($file['label'] === 'SKTL') {
                                        $url = route('operator.sktl.download', $skripsi->id);
                                    } elseif ($file['label'] === 'Dokumen Lengkap (Bab 1-5)') {
                                        $url = route('skripsi.download', $skripsi->id);
                                    }
                                @endphp
                                <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill mt-auto">
                                    <i class="bi bi-eye me-1"></i> Lihat
                                </a>
                            @else
                                <span class="text-muted small mt-auto"><i class="bi bi-dash-circle me-1"></i>Belum diupload</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right Column: Status Timeline --}}
        <div class="col-lg-4">
            <div class="card card-custom border-0 p-4">
                <h6 class="fw-bold mb-4"><i class="bi bi-signpost-split me-2 text-primary"></i>Timeline Status</h6>
                <div class="status-timeline">
                    @php
                        $statusOrder = ['draft', 'sktl_pending', 'sktl_verified', 'files_pending', 'files_verified', 'approved', 'published'];
                        $rejectedStatuses = ['sktl_rejected', 'files_rejected'];
                        $currentIdx = array_search($skripsi->status, $statusOrder);
                        $isRejected = in_array($skripsi->status, $rejectedStatuses);

                        $timelineSteps = [
                            ['key' => 'draft', 'label' => 'Pengajuan Dibuat', 'desc' => 'Mahasiswa memulai pengajuan'],
                            ['key' => 'sktl_pending', 'label' => 'SKTL Diajukan', 'desc' => 'Menunggu verifikasi operator'],
                            ['key' => 'sktl_verified', 'label' => 'SKTL Disetujui', 'desc' => 'Operator memverifikasi SKTL'],
                            ['key' => 'files_pending', 'label' => 'Berkas Diajukan', 'desc' => 'File skripsi dikirim untuk review'],
                            ['key' => 'files_verified', 'label' => 'Berkas Diverifikasi', 'desc' => 'Operator menyetujui berkas'],
                            ['key' => 'approved', 'label' => 'Disetujui Kaprodi', 'desc' => 'Persetujuan akhir Kaprodi'],
                            ['key' => 'published', 'label' => 'Terpublikasi', 'desc' => 'Tersedia di repositori publik'],
                        ];
                    @endphp

                    @foreach($timelineSteps as $step)
                        @php
                            $stepIdx = array_search($step['key'], $statusOrder);
                            if ($isRejected) {
                                if ($skripsi->status === 'sktl_rejected' && $step['key'] === 'sktl_pending') {
                                    $dotClass = 'rejected';
                                } elseif ($skripsi->status === 'files_rejected' && $step['key'] === 'files_pending') {
                                    $dotClass = 'rejected';
                                } elseif ($currentIdx === false && $stepIdx <= 1) {
                                    $dotClass = 'active';
                                } else {
                                    $dotClass = ($stepIdx !== false && $currentIdx !== false && $stepIdx < $currentIdx) ? 'active' : '';
                                }
                            } else {
                                if ($currentIdx !== false && $stepIdx !== false) {
                                    if ($stepIdx < $currentIdx) {
                                        $dotClass = 'active';
                                    } elseif ($stepIdx == $currentIdx) {
                                        $dotClass = 'pending';
                                    } else {
                                        $dotClass = '';
                                    }
                                } else {
                                    $dotClass = '';
                                }
                            }
                        @endphp
                        <div class="timeline-step">
                            <div class="timeline-dot {{ $dotClass }}"></div>
                            <div>
                                <div class="fw-semibold small {{ $dotClass ? 'text-dark' : 'text-muted' }}">{{ $step['label'] }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $step['desc'] }}</div>
                                @if($skripsi->status === 'sktl_rejected' && $step['key'] === 'sktl_pending')
                                    <span class="badge bg-danger rounded-pill mt-1 px-2 py-1" style="font-size: 0.7rem;">DITOLAK</span>
                                @endif
                                @if($skripsi->status === 'files_rejected' && $step['key'] === 'files_pending')
                                    <span class="badge bg-danger rounded-pill mt-1 px-2 py-1" style="font-size: 0.7rem;">DITOLAK</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection
