@extends('frontend.layouts.app')

@section('content')
    <section class="wow fadeIn bg-light-gray padding-35px-tb page-title-small top-space top-space">
        <div class="container">
            <div class="row equalize xs-equalize-auto">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 display-table">
                    <div class="display-table-cell vertical-align-middle text-left xs-text-center">
                        <h1 class="alt-font text-extra-dark-gray font-weight-600 no-margin-bottom text-uppercase">{{ $cat != 'search' ? 'Berita Kemahasiswaan' : 'Hasil pencarian : '. app('request')->input('keyword') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.artikel._item')
                @include('frontend.layouts._sidebar')
            </div>
        </div>
    </section>
@endsection