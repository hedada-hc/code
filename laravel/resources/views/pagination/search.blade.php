<ul class="pagination">
    @if(Request()->input('page') == 1)
        <li class="disabled"><span>上一页</span></li> 
    @else
        <li><a href="{{ FilterManager::url('page', Request()->input('page') - 1) }}" rel="prev">上一页</a></li> 
    @endif
    @if($page_count > 4)
        @for ($i = 1; $i <= 3; $i++)
            @if(Request()->input('page') == $i)
                <li class="active"><span>{{ $i }}</span></li>
            @else
                @if(!Request()->input('page') && $i == 1)
                    <li class="active"><span>1</span></li>
                @else
                    <li><a href="{{ FilterManager::url('page', $i) }}">{{ $i }}</a></li> 
                @endif
            @endif
        @endfor
        <li class="disabled"><span>...</span></li>
        @if(Request()->input('page') == $page_count)
            <li class="active"><span>{{ Request()->input('page') }}</span></li>
        @else
            <li><a href="{{ FilterManager::url('page', $page_count) }}">{{ $page_count }}</a></li> 
        @endif
    @else
        @for ($i = 1; $i <= $page_count; $i++)
            @if(Request()->input('page') == $i)
                <li class="active"><span>{{ $i }}</span></li>
            @else
                <li><a href="{{ FilterManager::url('page', $i) }}">{{ $i }}</a></li> 
            @endif
        @endfor
    @endif
    @if(Request()->input('page') == $page_count)
        <li class="disabled"><span>下一页</span></li>
    @else
        <li><a href="{{ FilterManager::url('page', Request()->input('page') + 1) }}" rel="next">下一页</a></li>
    @endif
</ul>

