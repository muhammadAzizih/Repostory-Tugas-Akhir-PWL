@extends('layouts.app')

@section('page_title', 'Verifikasi Email')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Alamat Email Anda</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        Tautan verifikasi baru telah dikirim ke alamat email Anda.
                    </div>

                    Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.
                    Jika Anda tidak menerima email tersebut,
                    <form class="d-inline" method="POST" action="#">
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klik di sini untuk meminta ulang</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
