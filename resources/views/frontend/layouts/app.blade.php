<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="author" content="Hendrik Agung">
        <meta name="description" content="Sistem Informasi Manajamen Mahasiswa, Alumni, dan Kerjasama POLTEKKES Negeri Tanjung Karang ">
        
        <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}">
        
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/et-line-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/justified-gallery.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/revolution/css/settings.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/revolution/css/layers.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/revolution/css/navigation.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootsnav.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" />
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}" />
        <!--[if IE]>
            <script src="{{ asset('assets/frontend/js/html5shiv.js') }}"></script>
        <![endif]-->

        @yield('css')
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default bootsnav navbar-fixed-top header-light {{ \Request::route()->getName() == 'f-home' ?  'bg-transparent' : 'bg-white'}} {{ \Request::route()->getName() == 'f-home' ? 'white-link' : '' }} nav-box-width">
                <div class="container nav-header-container">
                    <div class="row">
                        <div class="col-md-2 col-xs-5">
                            <a href="{{ route('f-home') }}" title="Pofo" class="logo">
                                <img src="{{ asset('assets/logo.png') }}" data-rjs="images/logo@2x.png" class="logo-dark" alt="Pofo">
                                <img src="{{ asset('assets/logo.png') }}" data-rjs="images/logo-white@2x.png" alt="Pofo" class="logo-light default">
                            </a>
                        </div>
                        <div class="col-md-7 col-xs-2 width-auto pull-right accordion-menu">
                            <button type="button" class="navbar-toggle collapsed pull-right" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                                <span class="sr-only">toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="navbar-collapse collapse pull-right" id="navbar-collapse-toggle-1">
                                <ul class="nav navbar-nav navbar-left panel-group no-margin alt-font font-weight-800">
                                    <li><a href="{{ route('f-home') }}" title="Home" class="inner-link">Beranda</a></li>
                                    <li class="dropdown simple-dropdown">
                                        <a href="javascript:void(0);">Kemahasiswaan</a>
                                        <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                        <!-- start sub menu -->
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('f-artikel') }}" title="Home" class="inner-link">Berita</a></li>
                                            <li><a href="{{ route('f-pengumuman') }}" title="Home" class="inner-link">Pengumuman</a></li>
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">Organisasi Kemahasiswaan <i class="fas fa-angle-right"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="about-us-simple.html">MPM</a></li>
                                                    <li><a href="about-us-classic.html">BEM</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown simple-dropdown">
                                        <a href="javascript:void(0);">Alumni</a>
                                        <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                        <!-- start sub menu -->
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('f-job') }}">Layanan Karir</a></li>
                                            <li><a href="about-us-classic.html">Survei</a></li>
                                            <li><a href="about-us-classic.html">Tracer Study</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#clients" title="Clients" class="inner-link">Unduh Berkas</a></li>
                                    <li><a href="#contact" title="Contact" class="inner-link">Kontak</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        
        @yield('content')

        <footer class="footer-clean-dark bg-extra-dark-gray padding-five-tb sm-padding-30px-tb">
            <div class="footer-widget-area padding-30px-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 widget sm-margin-50px-bottom xs-margin-30px-bottom sm-text-center xs-text-left">
                            <a href="{{ route('f-home') }}" class="display-inline-block">
                                <img class="footer-logo" src="{{ asset('assets/logo.png') }}" data-rjs="images/logo@2x.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 widget sm-margin-30px-bottom">
                            <div class="widget-title alt-font text-extra-small text-uppercase text-white-2 margin-15px-bottom font-weight-600">Alamat</div>
                            <div class="text-small line-height-24 width-75 text-medium-gray sm-width-100">Jl. Soekarno-Hatta No. 1 dan No. 6 </br>Kota Bandar Lampung</div>
                        </div>
                        <div class="col-lg-4 col-md-4 widget sm-margin-30px-bottom">
                            <div class="widget-title alt-font text-extra-small text-white-2 text-uppercase margin-15px-bottom font-weight-600">Kontak</div>
                            <div class="text-small line-height-24 text-medium-gray">Telp: 0721-783852</div>
                            <div class="text-small line-height-24 text-medium-gray">Fax: 0721-773918</div>
                            <div class="text-small line-height-24 text-medium-gray">Email: <a href=" mailto:kemahasiswaan@poltekkes-tjk.ac.id" class="text-medium-gray"> kemahasiswaan@poltekkes-tjk.ac.id</a></div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="border-color-medium-dark-gray border-top padding-30px-top">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 text-right text-small text-center text-medium-gray">Hak Cipta &COPY; {{ date('Y') }} &bull; Tim Kemahasiswaan &bull; <a href="https://runsel.web.id" target="_blank" title="Hendrik Agung" class="text-medium-gray">Runsel</a></div>
                    </div>
                </div>
            </div>
        </footer>

        <a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>
        <!-- end scroll to top  -->
        <!-- javascript libraries -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/modernizr.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.easing.1.3.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/skrollr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/smooth-scroll.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.appear.js') }}"></script>
        <!-- menu navigation -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/bootsnav.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.nav.js') }}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/swiper.min.js') }}"></script>
        <!-- counter -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.count-to.js') }}"></script>
        <!-- parallax -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.stellar.js') }}"></script>
        <!-- magnific popup -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- portfolio with shorting tab -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/isotope.pkgd.min.js') }}"></script>
        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
        <!-- pull menu -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/classie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/hamburger-menu.js') }}"></script>
        <!-- counter  -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/counter.js') }}"></script>
        <!-- fit video  -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.fitvids.js') }}"></script>
        <!-- equalize -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/equalize.min.js') }}"></script>
        <!-- skill bars  -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/skill.bars.jquery.js') }}"></script> 
        <!-- justified gallery  -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/justified-gallery.min.js') }}"></script>
        <!--pie chart-->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/instafeed.min.js') }}"></script>
        <!-- retina -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/retina.min.js') }}"></script>
        <!-- revolution -->
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
        <!-- revolution slider extensions (load below extensions JS files only on local file systems to make the slider work! The following part can be removed on server for on demand loading) -->
        <!--<script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>-->
        <!-- setting -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/main.js') }}"></script>

        @yield('script')
    </body>
</html>