<nav class="sj-pagination">
	<ul>
		{{-- Previous Page Link --}}
		@if ($paginator->onFirstPage())
			{{-- on first page --}}
		@else
		<li class="sj-prevpage"><a href="{{ $url }}"><i class="fa fa-angle-left"></i> Previous</a></li>
		@endif

		{{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
			@if (is_string($element))
				<li><a class="disabled" href="{{ $url }}">{{ $page < 10 ? '0' . $page : $page  }}</a></li>								
				{{-- <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li> --}}
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<li class="sj-active"><a href="{{ $url }}">{{ $page < 10 ? '0' . $page : $page  }}</a></li>					
                        {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
					@else
						<li><a href="{{ $url }}">{{ $page }}</a></li>					
                        {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                    @endif
                @endforeach
            @endif
        @endforeach

		@if ($paginator->hasMorePages())
		<li class="sj-nextpage"><a href="{{ $url }}">Next <i class="fa fa-angle-right"></i></a></li>
        @else
            {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li> --}}
        @endif
		{{--
			template
		<li class="sj-prevpage"><a href="#"><i class="fa fa-angle-left"></i> Previous</a></li>
		<li class="sj-active"><a href="#">01</a></li>
		<li><a href="#">02</a></li>
		<li><a href="#">03</a></li>
		<li><a href="#">04</a></li>
		<li><a href="#">05</a></li>
		--}}
	</ul>
</nav>