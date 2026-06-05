@extends('layouts.app')

@section('page_title', 'Masuk ke Sistem')

@section('content')
<style>
    /* ── Login Container ── */
    .login-container {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    /* ── Card ── */
    .login-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.10), 0 1px 3px rgba(0,0,0,0.04);
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.06);
        max-width: 920px;
        width: 100%;
        animation: fadeSlideUp 0.5s ease-out;
    }

    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Brand Side (Left Panel) ── */
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
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        top: -50px;
        right: -100px;
    }
    .login-brand-side::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }
    .login-brand-side .brand-icon {
        width: 64px;
        height: 64px;
        background: rgba(255,255,255,0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        backdrop-filter: blur(4px);
    }
    .login-brand-side .brand-icon i {
        font-size: 1.75rem;
    }

    /* ── Form Side (Right Panel) ── */
    .login-form-side {
        padding: 56px 48px;
        background: white;
    }

    /* ── Custom Input ── */
    .login-input-group {
        position: relative;
        display: flex;
        align-items: stretch;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.25s ease;
    }
    .login-input-group:focus-within {
        background: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-light);
    }
    .login-input-group .input-icon {
        display: flex;
        align-items: center;
        padding: 0 14px;
        color: #94a3b8;
        font-size: 1.1rem;
        flex-shrink: 0;
        transition: color 0.25s;
    }
    .login-input-group:focus-within .input-icon {
        color: var(--primary);
    }
    .login-input-group input {
        flex: 1;
        background: transparent;
        border: none;
        padding: 14px 14px 14px 0;
        font-size: 0.95rem;
        color: #1e293b;
        outline: none;
    }
    .login-input-group input::placeholder {
        color: #a0aec0;
    }
    .login-input-group .password-toggle {
        display: flex;
        align-items: center;
        padding: 0 14px;
        color: #94a3b8;
        cursor: pointer;
        background: none;
        border: none;
        font-size: 1.1rem;
        transition: color 0.2s;
    }
    .login-input-group .password-toggle:hover {
        color: var(--primary);
    }

    /* ── Error Messages ── */
    .login-input-group.is-invalid {
        border-color: #ef4444;
    }
    .login-input-group.is-invalid:focus-within {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    /* ── Button ── */
    .btn-login {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        padding: 14px 32px;
        font-size: 1.05rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-login::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 100%);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
        color: white;
    }
    .btn-login:hover::before {
        opacity: 1;
    }
    .btn-login:active {
        transform: translateY(0);
    }

    /* ── Divider ── */
    .login-divider {
        display: flex;
        align-items: center;
        gap: 16px;
        color: #cbd5e1;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 28px 0;
    }
    .login-divider::before,
    .login-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    /* ── Remember Me ── */
    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .form-check-input:focus {
        box-shadow: 0 0 0 3px var(--primary-light);
        border-color: var(--primary);
    }

    /* ── Mobile Header ── */
    .mobile-brand {
        padding: 24px 0 0;
    }
    .mobile-brand .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: var(--primary-light);
        border-radius: 50px;
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 12px;
    }

    /* ── Responsive ── */
    @media (max-width: 991.98px) {
        .login-form-side {
            padding: 36px 24px 40px;
        }
        .login-card {
            border-radius: 20px;
            margin: 0 8px;
        }
    }
    @media (max-width: 575.98px) {
        .login-form-side {
            padding: 28px 20px 32px;
        }
        .login-container {
            min-height: calc(100vh - 80px);
            padding: 12px 0;
        }
    }
</style>

<div class="container py-3">
    <div class="login-container">
        <div class="login-card row g-0">
            {{-- ═══════ Brand Side (Desktop) ═══════ --}}
            <div class="col-lg-5 d-none d-lg-flex login-brand-side">
                <div class="position-relative z-1">
                    <div class="brand-icon">
                        <i class="bi bi-layers-fill text-white"></i>
                    </div>
                    <h2 class="fw-bolder mb-3" style="font-size: 2rem; letter-spacing: -0.5px;">KELAR.IN</h2>
                    <p class="opacity-75 mb-4" style="font-size: 1.05rem; line-height: 1.6;">
                        Sistem Informasi Repositori Skripsi Tugas Akhir.
                    </p>
                    <div style="padding: 16px 20px; background: rgba(255,255,255,0.1); border-radius: 12px; backdrop-filter: blur(4px);">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-shield-check" style="font-size: 1.1rem;"></i>
                            <span class="small fw-medium">Akses aman & terenkripsi</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history" style="font-size: 1.1rem;"></i>
                            <span class="small fw-medium">Sesi tersimpan otomatis</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═══════ Form Side ═══════ --}}
            <div class="col-lg-7 login-form-side">
                {{-- Mobile Brand --}}
                <div class="d-lg-none text-center mobile-brand mb-4">
                    <div class="brand-badge">
                        <i class="bi bi-layers-fill"></i>
                        KELAR.IN
                    </div>
                </div>

                {{-- Heading --}}
                <div class="mb-4 text-center text-lg-start">
                    <h3 class="fw-bold mb-2" style="color: #1e293b; font-size: 1.55rem;">Selamat Datang Kembali</h3>
                    <p class="mb-0" style="color: #64748b; font-size: 0.95rem;">Masukkan kredensial akun Anda untuk melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold small" style="color: #475569; letter-spacing: 0.3px;">Alamat Email</label>
                        <div class="login-input-group @error('email') is-invalid @enderror">
                            <span class="input-icon">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="contoh@civitas.ut.ac.id">
                        </div>
                        @error('email')
                            <span class="text-danger small mt-2 d-block fw-medium">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label fw-semibold small mb-0" style="color: #475569; letter-spacing: 0.3px;">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a class="small fw-semibold text-decoration-none" href="{{ route('password.request') }}" style="color: var(--primary);">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <div class="login-input-group @error('password') is-invalid @enderror">
                            <span class="input-icon">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                            <button type="button" class="password-toggle" onclick="togglePassword()" tabindex="-1" aria-label="Tampilkan/Sembunyikan password">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-danger small mt-2 d-block fw-medium">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small" for="remember" style="color: #64748b;">
                                Ingat Saya
                            </label>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-login">
                            Masuk ke Sistem <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>

                {{-- Footer --}}
                <div class="mt-4 pt-3 text-center" style="border-top: 1px solid #f1f5f9;">
                    <p class="small mb-1" style="color: #94a3b8;">Belum memiliki akun?</p>
                    <p class="small fw-medium mb-0" style="color: #64748b;">
                        <i class="bi bi-info-circle me-1"></i>Hubungi Operator Fakultas masing-masing.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}
</script>
@endsection
