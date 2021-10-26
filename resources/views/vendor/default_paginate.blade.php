@if ($paginator->lastPage() > 1)
@php $link_limit=4 @endphp
<ul class="pagination" style="float: right !important">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url(1) }}"><img src="{{ asset('assets/images/assets/Sell_NFT/Path599.png') }}" class="img-fluid rotate-180" alt=""></a>
    </li>

     {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @php $i = 0 @endphp
            @foreach ($element as $page => $url)
                @if($i == $link_limit)
                    @php //continue; @endphp 
                @endif
                @if ($page == $paginator->currentPage())
                    <li><span class="font-12 mx-1 bg-warning px-1">{{$page}}</span></li>
                @else
                    <li><a style="color: #a3a4a5 !important;" class="font-12 mx-1" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @php $i++; @endphp
            @endforeach
        @endif
    @endforeach
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" ><img src="{{ asset('assets/images/assets/Sell_NFT/Path599.png') }}" class="img-fluid " alt=""></a>
    </li>
</ul>
@endif
