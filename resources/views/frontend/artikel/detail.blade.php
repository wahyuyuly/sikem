@extends('frontend.layouts.app')

@section('content')
<section class="wow fadeIn cover-background background-position-top" style="background-image:url('{{ asset('assets/frontend/images/artikel-header.png') }}');">
    <div class="opacity-medium bg-extra-dark-gray"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
                <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
                    <span class="text-white opacity6 alt-font margin-10px-bottom display-block text-uppercase text-small">{{ dateFormat($item->created_at) }}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;by <a href="#" class="text-white">{{ $item->user->name ?? '-' }}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#" class="text-white">{{ $item->Category->name ?? '-' }}</a></span>
                    <h3 class="text-white alt-font font-weight-600 margin-10px-bottom">{{ $item->title ?? '-' }}</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <main class="col-md-9 col-sm-12 col-xs-12 right-sidebar sm-margin-60px-bottom xs-margin-40px-bottom no-padding-left sm-no-padding-right">
                <div class="col-md-12 col-sm-12 col-xs-12 blog-details-text last-paragraph-no-margin">
                    @if (isset($item->image) && !empty($item->image))
                        <img src="{{ asset('storage/posts/cover/'.$item->image) }}" alt="{{ $item->slug ?? '' }}" class="width-100 margin-45px-bottom">
                    @else
                        <img src="{{ asset('assets/no-pict.png') }}" alt="{{ $item->slug ?? '' }}" class="width-100 margin-45px-bottom">
                    @endif

                    {!! $item->content ?? '' !!}

                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 margin-seven-bottom margin-eight-top">
                    <div class="divider-full bg-medium-light-gray"></div>
                </div>
            </main>
            
            @include('frontend.layouts._sidebar')
        </div>
    </div>
</section>
@endsection