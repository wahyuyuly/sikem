<main class="col-md-9 col-sm-12 col-xs-12 right-sidebar sm-margin-60px-bottom xs-margin-40px-bottom sm-padding-15px-lr">
    @foreach ($artikel as $item)
        <div class="equalize sm-equalize-auto blog-post-content margin-60px-bottom padding-60px-bottom display-inline-block border-bottom border-color-extra-light-gray sm-margin-30px-bottom sm-padding-30px-bottom xs-text-center sm-no-border">
            <div class="blog-image col-md-5 no-padding sm-margin-30px-bottom xs-margin-20px-bottom margin-45px-right sm-no-margin-right display-table">
                <div class="display-table-cell vertical-align-middle">
                    <a href="{{ route('f-detail', $item->slug) }}">
                        @if (isset($item->image) && !empty($item->image))
                            <img src="{{ asset('storage/posts/cover/'.$item->image) }}" alt="">
                        @else
                            <img src="{{ asset('assets/no-pict.png') }}" alt="">
                        @endif
                    </a>
                </div>
            </div>
            <div class="blog-text col-md-6 display-table no-padding">
                <div class="display-table-cell vertical-align-middle">
                    <div class="content margin-20px-bottom sm-no-padding-left ">
                        <a href="{{ route('f-detail', $item->slug) }}" class="text-extra-dark-gray margin-5px-bottom alt-font text-extra-large font-weight-600 display-inline-block">{{ $item->title ?? '-' }}</a>
                        <div class="text-medium-gray text-extra-small margin-15px-bottom text-uppercase alt-font">
                            <span>{{ $item->user->name ?? '-' }}</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            <span>17 july 2017</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#" class="text-medium-gray">Design</a></div>
                        <p class="no-margin width-95">{!! limitText($item->content, 45) !!}</p>
                    </div>
                    <a class="btn btn-very-small btn-dark-gray text-uppercase" href="{{ route('f-detail', $item->slug) }}">Selengkapnya</a>
                </div>
            </div>
        </div>                        
    @endforeach

    {{ $artikel->links('frontend.layouts._paginate') }}
</main>