@extends('layouts.app')

@section('page_title', 'Status Pengajuan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom border-0 p-4">
            <h5 class="fw-bold mb-4">Riwayat & Status Pengajuan</h5>

            @if(!$skripsi)
                <div class="text-center py-5">
                    <div class="display-1 text-muted mb-3"><i class="bi bi-file-earmark-x"></i></div>
                    <h5>Belum Ada Data</h5>
                    <p class="text-muted">Anda belum mengajukan dokumen apapun.</p>
                    <a href="{{ route('mahasiswa.sktl.create') }}" class="btn btn-primary-green">Upload SKTL Sekarang</a>
                </div>
            @else
                <div class="mb-5">
                    <h6 class="fw-bold text-muted mb-3">Informasi Skripsi</h6>
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted" width="150">Judul</td>
                            <td class="fw-semibold">{{ $skripsi->title }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jurusan</td>
                            <td class="fw-semibold">{{ $skripsi->jurusan->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Fakultas</td>
                            <td class="fw-semibold">{{ $skripsi->jurusan->fakultas->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Terakhir Update</td>
                            <td class="fw-semibold">{{ $skripsi->updated_at->translatedFormat('d M Y, H:i') }} WIB</td>
                        </tr>
                    </table>
                </div>

                <div class="position-relative ms-4 border-start border-2 pb-2">
                    
                    <!-- Step 1: Upload SKTL -->
                    <div class="mb-4 position-relative">
                        <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-success" style="width: 32px; height: 32px; left: -17px; top: 0;">
                            <i class="bi bi-check text-success fs-5"></i>
                        </div>
                        <div class="ms-4 ps-2">
                            <h6 class="fw-bold mb-1">Upload SKTL</h6>
                            <p class="small text-muted mb-0">File SKTL berhasil diunggah pada {{ $skripsi->created_at->translatedFormat('d M Y, H:i') }} WIB.</p>
                        </div>
                    </div>

                    <!-- Step 2: Verifikasi SKTL -->
                    <div class="mb-4 position-relative">
                        @php
                            $s2_color = 'secondary';
                            $s2_icon = 'bi-hourglass-split';
                            if(in_array($skripsi->status, ['sktl_verified', 'files_pending', 'files_verified', 'files_rejected', 'published'])) {
                                $s2_color = 'success';
                                $s2_icon = 'bi-check';
                            } elseif($skripsi->status == 'sktl_rejected') {
                                $s2_color = 'danger';
                                $s2_icon = 'bi-x';
                            }
                        @endphp
                        <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-{{ $s2_color }}" style="width: 32px; height: 32px; left: -17px; top: 0;">
                            <i class="bi {{ $s2_icon }} text-{{ $s2_color }} {{ $s2_icon == 'bi-check' ? 'fs-5' : '' }}"></i>
                        </div>
                        <div class="ms-4 ps-2">
                            <h6 class="fw-bold mb-1 text-{{ $s2_color }}">Verifikasi SKTL</h6>
                            @if($skripsi->status == 'sktl_pending')
                                <p class="small text-muted mb-0">Menunggu pengecekan dari Operator.</p>
                            @elseif($skripsi->status == 'sktl_rejected')
                                <p class="small text-danger mb-1">SKTL Anda ditolak. Alasan: {{ $skripsi->sktl_rejection_category }}</p>
                                <a href="{{ route('mahasiswa.sktl.reupload') }}" class="btn btn-sm btn-outline-danger py-0">Upload Ulang</a>
                            @else
                                <p class="small text-success mb-0">SKTL disetujui.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Step 3: Upload File -->
                    <div class="mb-4 position-relative">
                        @php
                            $s3_color = 'secondary';
                            $s3_icon = 'bi-circle';
                            if(in_array($skripsi->status, ['files_pending', 'files_verified', 'files_rejected', 'published'])) {
                                $s3_color = 'success';
                                $s3_icon = 'bi-check';
                            } elseif($skripsi->status == 'sktl_verified') {
                                $s3_color = 'primary';
                                $s3_icon = 'bi-hourglass-split';
                            }
                        @endphp
                        <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-{{ $s3_color }}" style="width: 32px; height: 32px; left: -17px; top: 0;">
                            <i class="bi {{ $s3_icon }} text-{{ $s3_color }} {{ $s3_icon == 'bi-check' ? 'fs-5' : '' }}"></i>
                        </div>
                        <div class="ms-4 ps-2">
                            <h6 class="fw-bold mb-1 text-{{ $s3_color }}">Upload File Skripsi Lengkap</h6>
                            @if($skripsi->status == 'sktl_verified')
                                <p class="small text-muted mb-1">Anda perlu mengunggah 4 file skripsi.</p>
                                <a href="{{ route('mahasiswa.files.create') }}" class="btn btn-sm btn-primary-green py-0">Upload Sekarang</a>
                            @elseif(in_array($skripsi->status, ['files_pending', 'files_verified', 'files_rejected', 'published']))
                                <p class="small text-success mb-0">File berhasil diunggah.</p>
                            @else
                                <p class="small text-muted mb-0">Menunggu proses verifikasi SKTL selesai.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Step 4: Verifikasi File -->
                    <div class="mb-4 position-relative">
                        @php
                            $s4_color = 'secondary';
                            $s4_icon = 'bi-circle';
                            if(in_array($skripsi->status, ['files_verified', 'published'])) {
                                $s4_color = 'success';
                                $s4_icon = 'bi-check';
                            } elseif($skripsi->status == 'files_pending') {
                                $s4_color = 'primary';
                                $s4_icon = 'bi-hourglass-split';
                            } elseif($skripsi->status == 'files_rejected') {
                                $s4_color = 'danger';
                                $s4_icon = 'bi-x';
                            }
                        @endphp
                        <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-{{ $s4_color }}" style="width: 32px; height: 32px; left: -17px; top: 0;">
                            <i class="bi {{ $s4_icon }} text-{{ $s4_color }} {{ $s4_icon == 'bi-check' ? 'fs-5' : '' }}"></i>
                        </div>
                        <div class="ms-4 ps-2">
                            <h6 class="fw-bold mb-1 text-{{ $s4_color }}">Verifikasi File & Plagiarisme</h6>
                            @if($skripsi->status == 'files_pending')
                                <p class="small text-muted mb-0">Menunggu pengecekan dari Operator.</p>
                            @elseif($skripsi->status == 'files_rejected')
                                <p class="small text-danger mb-1">File ditolak. Alasan: {{ $skripsi->file_rejection_category }}</p>
                                <a href="{{ route('mahasiswa.files.reupload') }}" class="btn btn-sm btn-outline-danger py-0">Upload Ulang</a>
                            @elseif(in_array($skripsi->status, ['files_verified', 'published']))
                                <p class="small text-success mb-0">File disetujui sesuai standar.</p>
                            @else
                                <p class="small text-muted mb-0">Menunggu upload file.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Step 5: Publikasi -->
                    <div class="position-relative">
                        @php
                            $s5_color = 'secondary';
                            $s5_icon = 'bi-circle';
                            if($skripsi->status == 'published') {
                                $s5_color = 'success';
                                $s5_icon = 'bi-stars';
                            } elseif($skripsi->status == 'files_verified') {
                                $s5_color = 'primary';
                                $s5_icon = 'bi-hourglass-split';
                            }
                        @endphp
                        <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-{{ $s5_color }}" style="width: 32px; height: 32px; left: -17px; top: 0;">
                            <i class="bi {{ $s5_icon }} text-{{ $s5_color }}"></i>
                        </div>
                        <div class="ms-4 ps-2">
                            <h6 class="fw-bold mb-1 text-{{ $s5_color }}">Persetujuan Kaprodi & Publikasi</h6>
                            @if($skripsi->status == 'files_verified')
                                <p class="small text-muted mb-0">Menunggu persetujuan akhir Ketua Program Studi.</p>
                            @elseif($skripsi->status == 'published')
                                <p class="small text-success mb-1">Skripsi telah terpublikasi!</p>
                                <a href="{{ route('skripsi.show', $skripsi->id) }}" class="btn btn-sm btn-success py-0">Lihat Publikasi</a>
                            @else
                                <p class="small text-muted mb-0">Belum mencapai tahap ini.</p>
                            @endif
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
</div>
@endsection
