@extends('frontend.layouts.app')

@section('content')
    <section class="wow fadeIn bg-extra-dark-gray padding-35px-tb page-title-small top-space top-space">
        <div class="container">
            <div class="row equalize xs-equalize-auto">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 display-table">
                    <div class="display-table-cell vertical-align-middle text-left xs-text-center">
                        <h1 class="alt-font text-white font-weight-600 no-margin-bottom text-uppercase">Pengumuman</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="wow fadeIn bg-light-gray">
        <div class="container"> 
            <div class="row equalize xs-equalize-auto">
                @foreach ($data as $item)
                    <div class="col-md-4 col-sm-6 col-xs-12 margin-30px-bottom xs-margin-15px-bottom wow fadeIn">
                        <div class="blog-post blog-post-style7 border-all border-color-light-gray padding-fourteen-all md-padding-ten-all xs-padding-30px-all bg-white inner-match-height">
                            <div class="post-details">
                                <span class="text-extra-small text-uppercase display-block margin-four-bottom sm-margin-two-bottom">{{ dateFormat($item->created_at) }}</span>
                                <span class="text-large alt-font margin-50px-bottom sm-margin-30px-bottom display-block"><a href="{{ route('f-announ', $item->slug) }}">{{ $item->title ?? '-' }}</a></span>
                                <div class="author padding-10px-top position-relative">
                                    <span class="text-uppercase text-extra-small">by <a href="javascript:void(0);">{{ $item->user->name ?? '-' }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $data->links('frontend.layouts._paginate') }}
        </div>
    </section>
@endsection