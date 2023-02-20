@extends('frontend.layouts.app')

@section('content')
    <section class="wow fadeIn cover-background background-position-top" style="background-image:url('{{ asset('assets/frontend/images//pengumuman-header.png') }}');">
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

    <section class="wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8 center-col last-paragraph-no-margin">
                    {!! $item->content !!}
                </div>
            </div>
            @if ($item->file != null)
                <div class="row" style="margin-top:40px;">
                    <div class="col-md-8 col-sm-8 col-xs-8 center-col last-paragraph-no-margin">
                        <a href="{{ route('file.public', ['pengumuman', $item->file]) }}" class="btn btn-small btn-dark-gray text-medium border-radius-4">Unduh Lampiran <i class="fas fa-cloud-download-alt icon-very-small" aria-hidden="true"></i></a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection