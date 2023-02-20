@extends('frontend.layouts.app')

@section('content')
    <section  class="bg-background-fade wow fadeIn no-padding cover-background color-code" data-color="1"  style="background-image: url('{{ asset('assets/frontend/images/banner.jpg') }}');">
        <div class="container full-screen position-relative">
            <div class="slider-typography text-left">
                <div class="slider-text-middle-main">
                    <div class="slider-text-middle">
                        <div class="col-lg-7 col-md-10 col-sm-10 center-col text-center">
                            <span class="after-before-separator text-extra-small alt-font text-white letter-spacing-3 xs-letter-spacing-0 text-uppercase margin-20px-bottom xs-margin-5px-bottom display-inline-block">Selamat datang di</span>
                            <h2 style="font-size: 18pt; line-height:40px;" class="font-weight-600 text-white alt-font margin-40px-bottom xs-margin-25px-bottom">Sistem Informasi </br>Kemahasiswaan, Alumni, dan Kerjasama</h2>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>

    <section class="wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 text-center center-col margin-eight-bottom xs-margin-30px-bottom">
                    <span class="alt-font text-deep-pink text-medium margin-5px-bottom display-block">Fasilitas Layanan</span>
                    <h5 class="font-weight-300 text-extra-dark-gray ">Layanan Utama SIMANJA</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 xs-margin-30px-bottom xs-text-center wow fadeInUp last-paragraph-no-margin">
                    <div class="col-md-3 col-sm-4 col-xs-12 no-padding-left pull-left xs-no-padding-right">
                        <i class="fas fa-user-graduate icon-extra-medium text-medium-gray xs-margin-10px-bottom position-relative top-minus3"></i>
                        <span class="separator-line-verticle-large margin-ten-right bg-deep-pink vertical-align-top pull-right margin-two-top hidden-xs"></span>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12 sm-no-padding-lr">
                        <a href="{{ route('login') }}">
                            <span class="text-medium margin-four-bottom text-extra-dark-gray alt-font display-block sm-margin-10px-bottom xs-margin-5px-bottom">Sistem Informasi Alumni</span>
                        </a>
                        <p class="width-90 md-width-100">Sistem informasi layanan administrasi alumni.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 xs-margin-30px-bottom xs-text-center wow fadeInUp last-paragraph-no-margin" data-wow-delay="0.2s">
                    <div class="col-md-3 col-sm-4 col-xs-12 no-padding-left pull-left xs-no-padding-right">
                        <i class="fas fa-user-md icon-extra-medium text-medium-gray xs-margin-10px-bottom position-relative top-minus3"></i>
                        <span class="separator-line-verticle-large margin-ten-right bg-deep-pink vertical-align-top pull-right margin-two-top hidden-xs"></span>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12 sm-no-padding-lr">
                        <h5 class="text-medium margin-four-bottom text-extra-dark-gray alt-font display-block sm-margin-10px-bottom xs-margin-5px-bottom">Layanan Karir</h5>
                        <p class="width-90 md-width-100">Layanan informasi karir bagi alumni Politeknik Kesehatan Negeri Tanjung Karang.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 xs-text-center wow fadeInUp last-paragraph-no-margin" data-wow-delay="0.4s">
                    <div class="col-md-3 col-sm-4 col-xs-12 no-padding-left pull-left xs-no-padding-right">
                        <i class="fas fa-graduation-cap icon-extra-medium text-medium-gray xs-margin-10px-bottom position-relative top-minus3"></i>
                        <span class="separator-line-verticle-large margin-ten-right bg-deep-pink vertical-align-top pull-right margin-two-top hidden-xs"></span>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12 sm-no-padding-lr">
                        <h5 class="text-medium margin-four-bottom text-extra-dark-gray alt-font display-block sm-margin-10px-bottom xs-margin-5px-bottom">Pencarian Alumni</h5>
                        <p class="width-90 md-width-100">Fasilitas pencarian data lulusuan/alumi Politeknik Kesehatan Negeri Tanjung Karang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wow fadeIn parallax" data-stellar-background-ratio="0.4" style="background-image:url('{{ asset('assets/frontend/images/g-direktorat.jpg') }}');">
        <div class="opacity-full bg-extra-dark-gray"></div>
        <div class="container position-relative">
            <div class="row equalize sm-equalize-auto">
                <!-- start feature box item -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table md-margin-15px-top sm-no-margin-top sm-margin-ten-bottom xs-padding-five-lr xs-margin-ten-bottom wow fadeIn last-paragraph-no-margin">
                    <div class="display-table-cell vertical-align-middle padding-fourteen-right sm-no-padding-right sm-text-center">
                        <h5 class="alt-font text-white">Tentang SIMANJA</h5>
                        <p class="width-85 md-width-100 xs-width-100 sm-margin-lr-auto text-medium-gray">
                            Sistem Informasi Kemahasiswaan, Alumni, dan Kerjasama disingkat SIMANJA adalah sistem informasi yang dibangun dengan tujuan mempermudah akses informasi bagi para Mahasiswa aktif maupun Alumni Politeknik Kesehatan Negeri Tanjung Karang. 
                        </p>
                    </div>
                </div>
                <!-- end feature box item -->
                <!-- start feature box item -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center display-table xs-margin-ten-bottom wow fadeIn" data-wow-delay="0.2s">
                    <div class="display-table-cell vertical-align-middle">
                        <a class="popup-youtube" href="https://www.youtube.com/watch?v=nrJtHemSPW4">
                            <img src="http://placehold.it/800x1022" alt="" class="width-100">
                            <div class="icon-play">
                                <div class="absolute-middle-center width-80">
                                    <img src="images/icon-play.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- end feature box item -->
                <!-- start feature box item -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center display-table wow fadeIn" data-wow-delay="0.4s">
                    <div class="display-table-cell vertical-align-middle">
                        <img src="http://placehold.it/800x1022" alt="" class="width-100">
                    </div>
                </div>
                <!-- end feature box item -->
            </div>
        </div>
    </section>

    <section class="border-top border-color-extra-light-gray wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 center-col margin-eight-bottom sm-margin-40px-bottom xs-margin-30px-bottom text-center">
                    <div class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">Berita</div>
                    <h5 class="alt-font text-extra-dark-gray font-weight-600">Artikel dan Berita Terbaru Kemahasiswaan</h5>
                </div>
            </div>
            <div class="row sm-col-2-nth">
                @foreach ($artikel as $item)
                    <div class="col-md-3 col-sm-6 col-xs-12 sm-margin-50px-bottom xs-margin-30px-bottom wow fadeInUp last-paragraph-no-margin xs-text-center" data-wow-duration="900ms">
                        <div class="blog-post blog-post-style1">
                            <div class="blog-post-images overflow-hidden margin-25px-bottom sm-margin-20px-bottom">
                                <a href="{{ route('f-detail', $item->slug) }}">
                                    @if (isset($item->image) && !empty($item->image))
                                        <img src="{{ asset('storage/posts/cover/'.$item->image) }}" alt="">
                                    @else
                                        <img src="{{ asset('assets/no-pict.png') }}" alt="">
                                    @endif
                                </a>
                            </div>
                            <div class="post-details">
                                <span class="post-author text-extra-small text-medium-gray text-uppercase display-block margin-10px-bottom">{{ dateFormat($item->created_at) }} | by <a href="blog-classic.html" class="text-link-dark-gray">{{ $item->user->name ?? '-' }}</a></span>
                                <a href="{{ route('f-detail', $item->slug) }}" class="post-title text-medium text-extra-dark-gray width-90 xs-width-100 display-block">{{ $item->title ?? '-' }}</a>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray margin-20px-tb sm-margin-15px-tb"></div>
                                <p class="width-90 sm-width-100">{!! limitText($item->content, 20) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <a href="{{ route('f-artikel') }}" class="btn btn-dark-gray btn-small text-extra-small border-radius-4 margin-30px-top"> Berita lainnya</a>
                </div>
            </div>
        </div>
    </section>
@endsection