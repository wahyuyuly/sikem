<aside class="col-md-3">
    <div class="display-inline-block width-100 margin-45px-bottom xs-margin-25px-bottom">
        {!! Form::open(['route' => 'f-artikelcari', 'method' => 'get']) !!}
            <div class="position-relative">
                {!! Form::text('keyword', null, ['class'=>'bg-transparent text-small no-margin border-color-extra-light-gray medium-input pull-left', ' placeholder'=>'Pencarian...']) !!}
                <button type="submit" class="bg-transparent  btn position-absolute right-0 top-1"><i class="fas fa-search no-margin-left"></i></button>
            </div> 
        {!! Form::close() !!}
    </div>

    <div class="margin-45px-bottom xs-margin-25px-bottom">
        <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase font-weight-600 text-small aside-title"><span>kategori</span></div>
        <ul class="list-style-6 margin-50px-bottom text-small">
            @foreach ($kategori as $item)
                <li><a href="blog-masonry.html">{{ $item->name ?? '-' }}</a><span>{{ $item->posts_count }}</span></li>
            @endforeach
        </ul>   
    </div>

    <div class="margin-45px-bottom xs-margin-25px-bottom">
        <div class="text-extra-dark-gray margin-25px-bottom alt-font text-uppercase font-weight-600 text-small aside-title"><span>Artikel Populer</span></div>
        <ul class="latest-post position-relative">
            @foreach ($populer as $item)
                <li>
                    <figure>
                        <a href="{{ route('f-detail', $item->slug) }}">
                            @if (isset($item->image) && !empty($item->image))
                                <img src="{{ asset('storage/posts/cover/'.$item->image) }}" alt="">
                            @else
                                <img src="{{ asset('assets/no-pict.png') }}" alt="">
                            @endif
                        </a>
                    </figure>
                    <div class="display-table-cell vertical-align-top text-small"><a href="{{ route('f-detail', $item->slug) }}" class="text-extra-dark-gray"><span class="display-inline-block margin-5px-bottom">{{ $item->title ?? '-' }}</span></a> <span class="clearfix text-medium-gray text-small">{{ dateFormat($item->created_at) }}</span></div>
                </li>
            @endforeach
        </ul>
    </div>
</aside>