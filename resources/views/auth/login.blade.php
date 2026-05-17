@extends('layouts.app')

@section('page_title', 'Masuk ke Sistem')

@section('content')
<style>
    .login-container {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
        max-width: 900px;
        width: 100%;
    }
    .login-brand-side {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .login-brand-side::before {
        content: ''; position: absolute; width: 300px; height: 300px;
        background: rgba(255,255,255,0.1); border-radius: 50%;
        top: -50px; right: -100px;
    }
    .login-brand-side::after {
        content: ''; position: absolute; width: 200px; height: 200px;
        background: rgba(255,255,255,0.05); border-radius: 50%;
        bottom: -50px; left: -50px;
    }
    .login-form-side {
        padding: 60px 50px;
        background: white;
    }
    .form-control-custom {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        padding: 14px 20px;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.2s;
    }
    .form-control-custom:focus {
        background-color: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-light);
    }
</style>

<div class="container py-4">
    <div class="login-container">
        <div class="login-card row g-0">
            <div class="col-lg-5 d-none d-lg-flex login-brand-side text-center text-lg-start">
                <div class="position-relative z-1">
                    <i class="bi bi-layers-fill display-3 mb-4 d-inline-block text-white"></i>
                    <h2 class="fw-bolder mb-3 display-6">KELAR.IN</h2>
                    <p class="lead opacity-75 mb-0" style="font-size: 1.1rem;">Sistem Informasi Repositori Skripsi Digital Universitas Terbuka.</p>
                </div>
            </div>
            
            <div class="col-lg-7 login-form-side">
                <div class="d-lg-none text-center mb-5">
                    <i class="bi bi-layers-fill display-4 text-primary mb-2 d-inline-block"></i>
                    <h3 class="fw-bolder text-dark">KELAR.IN</h3>
                </div>

                <div class="mb-5 text-center text-lg-start">
                    <h3 class="fw-bold text-dark mb-2">Selamat Datang Kembali</h3>
                    <p class="text-muted">Silakan masukkan kredensial akun Anda untuk melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold small text-uppercase text-muted" style="letter-spacing: 0.5px;">Alamat Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 px-3 text-muted">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control form-control-custom border-start-0 rounded-start-0 ps-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="contoh@civitas.ut.ac.id">
                        </div>
                        @error('email')
                            <span class="text-danger small mt-2 d-block fw-medium">
                                <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="password" class="form-label fw-bold small text-uppercase text-muted mb-0" style="letter-spacing: 0.5px;">Kata Sandi <span class="text-danger">*</span></label>
                            @if (Route::has('password.request'))
                                <a class="small fw-bold text-primary text-decoration-none" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 px-3 text-muted">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input id="password" type="password" class="form-control form-control-custom border-start-0 rounded-start-0 ps-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                            
                        </div>
                        @error('password')
                            <span class="text-danger small mt-2 d-block fw-medium">
                                <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted small" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary-custom py-3 fs-5 rounded-pill">
                            Masuk ke Sistem <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>

                <div class="mt-5 text-center">
                    <p class="text-muted small mb-0">Belum memiliki akun?</p>
                    <p class="text-muted small fw-medium">Mahasiswa harap menghubungi Operator Fakultas masing-masing.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('bi-eye');
                this.querySelector('i').classList.toggle('bi-eye-slash');
            });
        }
    });
</script>
@endsection
