<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/vendor/izitoast/css/iziToast.min.css') }}">
        
        @yield('css')
    </head>
    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                @include('backend.layouts._navbar')

                @include('backend.layouts._sidemenu')

                <div class="main-content">
                    @yield('content')
                </div>

                <footer class="main-footer">
                    <div class="footer-left">
                        Hak Cipta &copy; {{ date('Y') }} 
                        <div class="bullet"></div>
                        Dibuat oleh <a href="https://runsel.web.id" target="_blank">Runsel</a>
                        <div class="bullet"></div>
                        Tim Kemahasiswaan
                    </div>
                    <div class="footer-right">
                    </div>
                </footer>
            </div>
        </div>

        <script src="{{ asset('assets/backend/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/backend/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/backend/vendor/izitoast/js/iziToast.min.js')}}"></script>
        <script>
            $( document ).ajaxError(function(event, jqxhr, settings, thrownError) {
                if(jqxhr.status == 403 && jqxhr.statusText == 'Forbidden') {
                    iziToast.warning({
                        timeout: 2000,
                        title: jqxhr.statusText,
                        message: jqxhr.responseJSON.message,
                        position: 'topRight',
                        displayMode: 'once',
                        onClosing: function() {
                            location.href = jqxhr.responseJSON.url;
                        }
                    });
                }
            });
            $(function() {
                //setTimeout('#notif'.hide(), 3000);
                setTimeout(function() {
                    $('#notif').fadeOut('1500');
                }, 3000);
            });
        </script>
        @yield('scripts')
    </body>
</html>