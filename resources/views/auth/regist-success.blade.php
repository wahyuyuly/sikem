<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Sistem Informasi Kemahasiswaan">
        <meta name="author" content="Hendrik Agung">
        <meta name="url" content="https://runsel.web.id">
        <!-- https://runsel.web.id -->

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}">
        <link href="{{ asset('assets/auth/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/auth/css/common.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&amp;display=swap" rel="stylesheet">
        <link href="{{ asset('assets/auth/css/theme-07.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="forny-container">
            <div class="forny-inner">
                <div class="forny-two-pane">
                    <div>
                        <div style="width:75%" class="forny-form">
                            <div class="mb-6 forny-logo">
                                <img style="width:220px;" src="{{ asset('assets/logo.png') }}">
                            </div>
                            <div class="reset-form d-block">
                                <div class="reset-password-form">
                                    <h4 class="mb-5">Pendaftaran Berhasil</h4>
                                    <p class="mb-5">
                                        Akun anda saat ini masih dalam tahap verifikasi oleh admin, email notifikasi akan dikirimkan jika akun anda telah aktif.
                                    </p>
                                    <p>
                                        Silakan menghubungi administrator jika anda memiliki kendala.
                                    </p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('login') }}"><button class="btn btn-primary">Masuk</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/auth/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/auth/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/auth/js/main.js') }}"></script>
        <script src="{{ asset('assets/auth/js/demo.js') }}"></script>
    </body>
</html>