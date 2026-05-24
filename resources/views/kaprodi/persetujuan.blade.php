@extends('layouts.app')

@section('page_title', 'Persetujuan Akhir Skripsi')

@section('content')
<div class="card card-custom border-0 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Antrean Persetujuan Dokumen Skripsi</h5>
        <span class="badge bg-warning text-dark">{{ $skripsis->count() }} Menunggu</span>
    </div>

    @if($skripsis->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-check-circle display-1 text-success opacity-25 mb-3 d-block"></i>
            <h6 class="text-muted">Tidak ada dokumen yang menunggu persetujuan.</h6>
        </div>
    @else
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
                    @foreach($skripsis as $skripsi)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $skripsi->user->name }}</div>
                                <div class="small text-muted">{{ $skripsi->jurusan->name }}</div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 250px;" title="{{ $skripsi->title }}">
                                    {{ $skripsi->title }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $skripsi->cover_file_path) }}" target="_blank" class="badge bg-danger text-decoration-none">Cover</a>
                                <a href="{{ asset('storage/' . $skripsi->abstrak_file_path) }}" target="_blank" class="badge bg-danger text-decoration-none">Abstrak</a>
                                <a href="{{ asset('storage/' . $skripsi->daftar_pustaka_file_path) }}" target="_blank" class="badge bg-danger text-decoration-none">Daftar Pustaka</a>
                                @if($skripsi->jurnal_file_path)
                                    <a href="{{ asset('storage/' . $skripsi->jurnal_file_path) }}" target="_blank" class="badge bg-info text-decoration-none text-dark">Jurnal</a>
                                @endif
                                @if($skripsi->turnitin_file_path)
                                    <a href="{{ asset('storage/' . $skripsi->turnitin_file_path) }}" target="_blank" class="badge bg-info text-decoration-none text-dark">Turnitin</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('skripsi.download', $skripsi->id) }}#toolbar=0" target="_blank" class="badge bg-danger text-decoration-none"><i class="bi bi-eye-fill"></i> Lihat Full {{ $skripsi->sebutan }}</a>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('kaprodi.approve', $skripsi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui dan mempublikasikan dokumen ini ke repositori?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-check-circle me-1"></i> Approve
                                        </button>
                                    </form>
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
