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
        <link href="{{ asset('assets/auth/css/theme-06.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="forny-container">
            <div class="forny-inner">
                <div class="forny-two-pane">
                    <div>
                        <div class="forny-form">
                            <div class="reset-form d-block">
                                {!! Form::open(['url'=>route('password.email'), 'method'=>'post' , 'class'=>'reset-password-form']) !!}
                                    <h4 class="mb-5">Reset password</h4>
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <p class="mb-10">
                                        Masukkan email anda yang terdaftar dan kami akan mengirimkan tautan untuk mereset password ke email anda.
                                    </p>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16">
                                                        <g transform="translate(0)">
                                                            <path d="M23.983,101.792a1.3,1.3,0,0,0-1.229-1.347h0l-21.525.032a1.169,1.169,0,0,0-.869.4,1.41,1.41,0,0,0-.359.954L.017,115.1a1.408,1.408,0,0,0,.361.953,1.169,1.169,0,0,0,.868.394h0l21.525-.032A1.3,1.3,0,0,0,24,115.062Zm-2.58,0L12,108.967,2.58,101.824Zm-5.427,8.525,5.577,4.745-19.124.029,5.611-4.774a.719.719,0,0,0,.109-.946.579.579,0,0,0-.862-.12L1.245,114.4,1.23,102.44l10.422,7.9a.57.57,0,0,0,.7,0l10.4-7.934.016,11.986-6.04-5.139a.579.579,0,0,0-.862.12A.719.719,0,0,0,15.977,110.321Z" transform="translate(0 -100.445)"/>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Alamat email anda']) !!}
                                        </div>
                                    </div>
                                    {!! $errors->first('email', '<p class="invalid-feedback" style="display:block;">:message</p>') !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="right-pane">
                        <div class="text-center" style="color: #fff; width: 300px; margin-top:-140px">
                            <div class="mb-10 forny-logo">
                                <img style="width:220px;margin-top: 70px;" src="{{ asset('assets/logo-w.png') }}">
                            </div>
                            <div class="mt-8">
                                <h4 class="mb-4">Selamat Datang</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/auth/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/auth/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/auth/js/main.js') }}"></script>
    </body>
</html>