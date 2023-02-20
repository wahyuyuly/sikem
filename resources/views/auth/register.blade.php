<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="description" content="Sistem Informasi Administrasi Kemahasiswaan dan Alumni">
        <meta name="author" content="Hendrik Agung">
        <meta name="url" content="https://runsel.web.id">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/icon.png') }}" />
        <link rel="stylesheet" href="{{ asset('assets/backend/css/app.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/css/components.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    
        <style>
            .selection .select2-selection {
                border-color: '#dc3545' !important;
            }
    
            .select2-container{ width: 100% !important; }
    
            .ms-choice {
                border: 0px solid #aaa;
            }
    
            .ms-choice>span {
                position:inherit;
            }
        </style>
    </head>
    <body>
        <div class="loader"></div>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row row clearfix">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Registrasi Pengguna Baru</h4>
                                </div>
                                <div class="card-body">
                                    {!! Form::open(['url'=>route('regist.create'), 'id'=>'register', 'method'=>'post', 'files'=>'true']) !!}
                                        <h3>Informasi Pribadi</h3>
                                        <fieldset>
                                            @include('backend.mahasiswa.inc._form', ['disable'=>true])
                                        </fieldset>

                                        <h3>Akademik</h3>
                                        <fieldset>
                                            @include('backend.mahasiswa.inc._akademik', ['disable'=>true])
                                        </fieldset>
                                        <h3>Riwayat Sekolah</h3>
                                        <fieldset>
                                            @include('backend.mahasiswa.inc._sekolah', ['disable'=>true])
                                        </fieldset>
                                        <h3>Orang Tua</h3>
                                        <fieldset>
                                            @include('backend.mahasiswa.inc._ortu', ['disable'=>true])
                                        </fieldset>
                                        <h3>Minat Bakat</h3>
                                        <fieldset>
                                            @include('backend.mahasiswa.inc._minat-bakat', ['disable'=>true])
                                        </fieldset>
                                        <h3>Riwayat Sakit</h3>
                                        <fieldset>
                                            @include('backend.mahasiswa.inc._penyakit', ['disable'=>true])
                                        </fieldset>
                                        <h3>Akun</h3>
                                        <fieldset>
                                            @include('backend.mahasiswa.inc._akun', ['disable'=>true])
                                        </fieldset>
                                    {!! Form::close() !!}
                                </div>
                    
                                <div class="mb-4 text-muted text-center">
                                    Sudah memiliki akun? <a href="{{ route('login') }}">Masuk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script src="{{ asset('assets/backend/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/backend/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/backend/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/backend/vendor/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
        <script src="{{ asset('assets/backend/vendor/cleave.js/dist/cleave.min.js') }}"></script>
        <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
        @include('backend.mahasiswa._js')
        <script>
            $(document).ready(function() {
                $(function () {
                    //Horizontal form basic
                    $('#register').steps({
                        headerTag: 'h3',
                        bodyTag: 'fieldset',
                        transitionEffect: 'slideLeft',
                        onInit: function (event, currentIndex) {
                            setButtonWavesEffect(event);
                        },
                        onStepChanged: function (event, currentIndex, priorIndex) {
                            setButtonWavesEffect(event);
                        },
                        onFinishing: function (event, currentIndex) {
                            $('#register').submit();
                        },
                        labels: {
                            cancel: "Batal",
                            current: "current step:",
                            pagination: "Pagination",
                            finish: "Daftar",
                            next: "Selanjutnya",
                            previous: "Sebelumnya",
                            loading: "Loading ..."
                        }
                    });
                });

                function setButtonWavesEffect(event) {
                    $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
                    $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
                }
            });
        </script>        
    </body>
</html>