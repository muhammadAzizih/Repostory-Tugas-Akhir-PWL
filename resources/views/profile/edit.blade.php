<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .btn-primary-green {
            background-color: #10b981;
            border-color: #10b981;
            color: #fff;
        }
        .btn-primary-green:hover {
            background-color: #059669;
            border-color: #059669;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom border-0 p-4">
            <h5 class="fw-bold mb-4">Pengaturan Akun</h5>

            <form action="#" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control bg-light border-0" value="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Email</label>
                    <input type="email" name="email" class="form-control bg-light border-0" value="" required>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold mb-3">Ubah Password <span class="text-muted small fw-normal">(Opsional)</span></h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password Baru</label>
                    <input type="password" name="password" class="form-control bg-light border-0" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control bg-light border-0" placeholder="Ulangi password baru">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary-green px-5 rounded-pill shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
