<ul class="pagination">
    @if($paginator->currentPage() == 1)
        <li class="disabled"><span>上一页</span></li> 
    @else
        <li><a href="{{ $paginator->url($paginator->currentPage() - 1) }}" rel="prev">上一页</a></li> 
    @endif
    @if($paginator->lastPage() > 4)
        @for ($i = 1; $i <= 3; $i++)
            @if($paginator->currentPage() == $i)
                <li class="active"><span>{{ $i }}</span></li>
            @else
                <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li> 
            @endif
        @endfor
        <li class="disabled"><span>...</span></li>
        @if($paginator->currentPage() == $paginator->lastPage())
            <li class="active"><span>{{ $paginator->currentPage() }}</span></li>
        @else
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li> 
        @endif
    @else
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if($paginator->currentPage() == $i)
                <li class="active"><span>{{ $i }}</span></li>
            @else
                <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li> 
            @endif
        @endfor
    @endif
    @if($paginator->currentPage() == $paginator->lastPage())
        <li class="disabled"><span>下一页</span></li>
    @else
        <li><a href="{{ $paginator->url($paginator->currentPage() + 1) }}" rel="next">下一页</a></li>
    @endif
</ul>

