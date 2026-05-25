@extends('layouts.app')

@section('page_title', 'Verifikasi SKTL')

@section('content')
<div class="card card-custom border-0 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Antrean Verifikasi SKTL</h5>
        <span class="badge bg-warning text-dark">{{ $skripsis->count() }} Menunggu</span>
    </div>

    @if($skripsis->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-check-circle display-4 mb-3 d-block text-success opacity-50"></i>
            <h6>Tidak ada antrean SKTL saat ini.</h6>
            <p class="small">Semua pengajuan telah diproses.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Judul Skripsi</th>
                        <th>File SKTL</th>
                        <th>Waktu Pengajuan</th>
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
                                <a href="{{ route('operator.sktl.download', $skripsi->id) }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="bi bi-file-pdf me-1"></i> Lihat PDF
                                </a>
                            </td>
                            <td>
                                <span class="small text-muted">{{ $skripsi->updated_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('operator.verifikasi.sktl.verify', $skripsi->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm" onclick="return confirm('Setujui SKTL ini?')">
                                            <i class="bi bi-check-lg me-1"></i> Terima
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $skripsi->id }}">
                                        <i class="bi bi-x-lg me-1"></i> Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Reject Modals -->
        @foreach($skripsis as $skripsi)
                        <div class="modal fade" id="rejectModal{{ $skripsi->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header border-0 bg-danger text-white">
                                        <h5 class="modal-title fw-bold"><i class="bi bi-exclamation-triangle me-2"></i> Tolak SKTL</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('operator.verifikasi.sktl.reject', $skripsi->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body p-4">
                                            <p class="small text-muted mb-4">Mahasiswa: <strong>{{ $skripsi->user->name }}</strong></p>
                                            
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Kategori Penolakan <span class="text-danger">*</span></label>
                                                <select name="category" class="form-select bg-light border-0" required>
                                                    <option value="">-- Pilih Alasan --</option>
                                                    <option value="SKTL tidak valid">SKTL tidak valid</option>
                                                    <option value="SKTL sudah kadaluarsa">SKTL sudah kadaluarsa</option>
                                                    <option value="SKTL tidak terbaca / buram">SKTL tidak terbaca / buram</option>
                                                    <option value="SKTL bukan dari institusi ini">SKTL bukan dari institusi ini</option>
                                                    <option value="Data SKTL tidak sesuai identitas mahasiswa">Data SKTL tidak sesuai identitas mahasiswa</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Catatan Tambahan (Opsional)</label>
                                                <textarea name="notes" class="form-control bg-light border-0" rows="3" placeholder="Tulis catatan revisi untuk mahasiswa..."></textarea>
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
                    @endforeach
    @endif
</div>
@endsection
