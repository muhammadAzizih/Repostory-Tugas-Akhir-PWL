@extends('layouts.app')

@section('page_title', 'Koleksi Publikasi')

@section('content')
<style>
    .search-group-custom {
        border: 1.5px solid var(--primary);
        border-radius: 30px;
        background-color: #fff;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .search-group-custom:focus-within {
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.15);
        border-color: var(--primary-dark, #157347);
    }
    .search-group-custom .input-group-text {
        border: none !important;
        background-color: transparent !important;
    }
    .search-group-custom .form-control {
        border: none !important;
        background-color: transparent !important;
        box-shadow: none !important;
    }
    .search-group-custom .btn-reset {
        border: none !important;
        background-color: transparent !important;
        box-shadow: none !important;
    }
</style>

<div class="card card-custom border-0 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0">Daftar Karya Ilmiah Terpublikasi</h5>
            <small class="text-muted">Koleksi skripsi mahasiswa yang telah disetujui Kaprodi dan terbit di repositori.</small>
        </div>
        <span class="badge bg-success rounded-pill px-3 py-2 fs-7">{{ $skripsis->count() }} Dokumen Terbit</span>
    </div>

    {{-- Search Form --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('operator.publikasi') }}" method="GET" class="d-flex gap-2">
                <div class="input-group search-group-custom">
                    <span class="input-group-text pe-0"><i class="bi bi-search text-success"></i></span>
                    <input type="text" name="search" class="form-control ps-2" placeholder="Cari nama penulis atau judul..." value="{{ $search ?? '' }}">
                    @if($search)
                        <a href="{{ route('operator.publikasi') }}" class="btn btn-reset d-flex align-items-center justify-content-center px-3" title="Reset Pencarian">
                            <i class="bi bi-x-lg text-danger"></i>
                        </a>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Cari</button>
            </form>
        </div>
    </div>

    @if($skripsis->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted opacity-25 mb-3 d-block"></i>
            <h6 class="text-muted">
                @if($search)
                    Pencarian untuk "{{ $search }}" tidak ditemukan.
                @else
                    Belum ada karya ilmiah yang dipublikasikan untuk program studi ini.
                @endif
            </h6>
            @if($search)
                <a href="{{ route('operator.publikasi') }}" class="btn btn-sm btn-outline-secondary rounded-pill mt-3">Reset Pencarian</a>
            @endif
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="200">Mahasiswa</th>
                        <th>Judul Karya Ilmiah</th>
                        <th>Tanggal Terbit</th>
                        <th>Berkas Publik</th>
                        <th class="text-center" width="150">Aksi</th>
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
                                <div class="fw-semibold text-dark text-wrap" style="max-width: 400px;">
                                    {{ $skripsi->title }}
                                </div>
                            </td>
                            <td class="small text-muted">
                                {{ $skripsi->updated_at->translatedFormat('d M Y, H:i') }} WIB
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ asset('storage/' . $skripsi->cover_file_path) }}" target="_blank" class="badge bg-danger text-decoration-none">Cover</a>
                                    <a href="{{ asset('storage/' . $skripsi->abstrak_file_path) }}" target="_blank" class="badge bg-danger text-decoration-none">Abstrak</a>
                                    <a href="{{ asset('storage/' . $skripsi->daftar_pustaka_file_path) }}" target="_blank" class="badge bg-danger text-decoration-none">Daftar Pustaka</a>
                                    @if($skripsi->jurnal_file_path)
                                        <a href="{{ asset('storage/' . $skripsi->jurnal_file_path) }}" target="_blank" class="badge bg-info text-decoration-none text-dark">Jurnal</a>
                                    @endif
                                    @if($skripsi->turnitin_file_path)
                                        <a href="{{ asset('storage/' . $skripsi->turnitin_file_path) }}" target="_blank" class="badge bg-secondary text-decoration-none">Turnitin</a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('skripsi.show', $skripsi->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3" target="_blank">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <form action="{{ route('operator.skripsi.destroy', $skripsi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data publikasi skripsi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-circle" title="Hapus Publikasi">
                                            <i class="bi bi-trash"></i>
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
