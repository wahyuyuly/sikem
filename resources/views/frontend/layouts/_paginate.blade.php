<div class="col-md-12 col-sm-12 col-xs-12 text-center margin-100px-top sm-margin-50px-top position-relative wow fadeInUp">
    <div class="pagination text-small text-uppercase text-extra-dark-gray">
        <ul>
            @if ($paginator->onFirstPage())
                <li class="active"><a href="#" onclick="return false;"><i class="fas fa-long-arrow-alt-left margin-5px-right xs-display-none"></i> Sebelumnya</a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-long-arrow-alt-left margin-5px-right xs-display-none"></i> Sebelumnya</a></li>
            @endif
            
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a href="#" onclick="return false;">{{ $element }}</a></li>
                @endif
        
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="#" onclick="return false;">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}">Selanjutnya <i class="fas fa-long-arrow-alt-right margin-5px-left xs-display-none"></i></a></li>
            @else
                <li class="active"><a href="#" onclick="return false;">Selanjutnya <i class="fas fa-long-arrow-alt-right margin-5px-left xs-display-none"></i></a></li>
            @endif
        </ul>
    </div>
</div>