@if($usertype == 'activeadmin' && $page->content == null)
    <div id='new-tab' class='component-tab'>
        <a class='new-link' href="{{ route('page.create') }}"><div class='new-content' >+</div></a>
    </div> 
    <div id="pageContent" class="collection">
    </div>
@else
    <div id="pageContent" class="collection">
        <div class='postContainer' id="contact">
            @if($usertype == 'activeadmin')
            <div id='modify-tab' class='component-tab'>
                <a class='delete-link' href="{{ route('page.delete', ['id'=>$page->id]) }}"><div class='delete-content' >-</div></a>
                <a class='edit-link' href="{{ route('page.edit', ['id'=>$page->id]) }}"><div class='edit-content' >#</div></a>
            </div>
            @endif
            @if($page->content != null)
            <div class="dsc">
                {!! $page->content !!}
            </div>
            @endif
        </div>
    </div>
@endif