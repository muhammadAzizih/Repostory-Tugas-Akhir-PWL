@extends('layouts.app')

@section('page_title', 'Riwayat Pengajuan')

@section('content')
<div class="card card-custom border-0 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0">Riwayat Pengajuan Skripsi</h5>
            <small class="text-muted">Pantau seluruh riwayat aktivitas, progress, dan status berkas skripsi mahasiswa.</small>
        </div>
        <span class="badge bg-secondary rounded-pill px-3 py-2 fs-7">{{ $skripsis->count() }} Total Pengajuan</span>
    </div>

    @if($skripsis->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-clock-history display-1 text-muted opacity-25 mb-3 d-block"></i>
            <h6 class="text-muted">Belum ada riwayat aktivitas pengajuan di prodi ini.</h6>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="200">Mahasiswa</th>
                        <th>Judul Skripsi</th>
                        <th>Tanggal Update</th>
                        <th>Status Dokumen</th>
                        <th class="text-center" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skripsis as $skripsi)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $skripsi->user->name }}</div>
                                <div class="small text-muted">{{ $skripsi->user->email }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark text-wrap" style="max-width: 380px;">
                                    {{ $skripsi->title }}
                                </div>
                            </td>
                            <td class="small text-muted">
                                {{ $skripsi->updated_at->translatedFormat('d M Y, H:i') }} WIB
                            </td>
                            <td>
                                @php
                                    $statusBadges = [
                                        'draft' => ['bg' => 'secondary', 'label' => 'Draf Awal'],
                                        'sktl_pending' => ['bg' => 'warning text-dark', 'label' => 'Verifikasi SKTL'],
                                        'sktl_verified' => ['bg' => 'primary', 'label' => 'SKTL Disetujui'],
                                        'sktl_rejected' => ['bg' => 'danger', 'label' => 'SKTL Ditolak'],
                                        'files_pending' => ['bg' => 'warning text-dark', 'label' => 'Verifikasi Berkas'],
                                        'files_verified' => ['bg' => 'info text-dark', 'label' => 'Menunggu Approval Kaprodi'],
                                        'files_rejected' => ['bg' => 'danger', 'label' => 'Berkas Ditolak'],
                                        'approved' => ['bg' => 'success', 'label' => 'Disetujui'],
                                        'published' => ['bg' => 'success', 'label' => 'Terpublikasi ']
                                    ];
                                    $badge = $statusBadges[$skripsi->status] ?? ['bg' => 'secondary', 'label' => 'Tidak Diketahui'];
                                @endphp
                                <span class="badge bg-{{ $badge['bg'] }} rounded-pill px-3 py-2 fw-semibold" style="font-size: 0.78rem;">
                                    {{ $badge['label'] }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('operator.riwayat.detail', $skripsi->id) }}" class="btn btn-sm btn-light border rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
