@extends('layouts.app')

@section('page_title', 'Kelola Mahasiswa')

@section('content')
<div class="card card-custom border-0 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Akun Mahasiswa</h5>
        <button type="button" class="btn btn-primary-green px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#createStudentModal">
            <i class="bi bi-person-plus me-1"></i> Tambah Mahasiswa
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>Status Pengajuan</th>
                    <th>Terdaftar Sejak</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=10b981&color=fff&rounded=true" alt="Avatar" width="40" height="40" class="shadow-sm">
                                <div>
                                    <div class="fw-bold text-dark">{{ $student->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted">{{ $student->email }}</td>
                        <td>
                            @if($student->skripsi)
                                @if($student->skripsi->status == 'sktl_pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass me-1"></i> SKTL Pending</span>
                                @elseif($student->skripsi->status == 'files_pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass me-1"></i> File Pending</span>
                                @elseif($student->skripsi->status == 'published')
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Published</span>
                                @else
                                    <span class="badge bg-info text-dark">{{ ucwords(str_replace('_', ' ', $student->skripsi->status)) }}</span>
                                @endif
                            @else
                                <span class="badge bg-secondary opacity-50">Belum Mengajukan</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $student->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-sm btn-light rounded-circle text-primary" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('operator.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun mahasiswa ini? Data skripsi terkait juga akan terhapus jika ada.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light rounded-circle text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header border-0 bg-light">
                                    <h5 class="modal-title fw-bold">Edit Data Mahasiswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('operator.students.update', $student->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Alamat Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary-green rounded-pill px-4">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data mahasiswa terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold">Tambah Akun Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('operator.students.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0 bg-info bg-opacity-10 small mb-4">
                        <i class="bi bi-info-circle me-1"></i> Buat akun untuk mahasiswa yang ingin mengunggah dokumen skripsi.
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control bg-light border-0" required placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email" name="email" class="form-control bg-light border-0" required placeholder="email@mahasiswa.ut.ac.id">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Default</label>
                        <input type="password" name="password" class="form-control bg-light border-0" required placeholder="Minimal 8 karakter">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control bg-light border-0" required placeholder="Ulangi password">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-green rounded-pill px-4">Buat Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
