@extends('layouts.app')

@section('page_title', 'Konfirmasi Kata Sandi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Konfirmasi Kata Sandi</div>

                <div class="card-body">
                    Harap konfirmasi kata sandi Anda sebelum melanjutkan.

                    <form method="POST" action="#">

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Kata Sandi</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Konfirmasi Kata Sandi
                                </button>
                                <a class="btn btn-link" href="email.blade.php">
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
