<?php
    if(isset($ajaxCategory)) $ajaxCategory = ucfirst($ajaxCategory);
?>
@if($usertype == 'activeadmin')
<div id='new-tab' class='component-tab'>
    <a title='create' class='new-link' href="{{ route('blog.create') }}"><div class='new-content' >+</div></a>
</div>
@endif
<div id="blogContent" class="collection">
    <div class="welcomeTitle">My&nbsp;Work</div>
    @forelse($posts as $post)
    <div class='postContainer' id="post{{ $post->id }}">
        
        @if($usertype == 'activeadmin')
        <div id='modify-tab' class='component-tab'>
            <a title='delete' class='delete-link' href="{{ route('blog.delete', ['id'=>$post->id]) }}"><div class='delete-content' >-</div></a>
            <a title='edit' class='edit-link' href="{{ route('blog.edit', ['id'=>$post->id]) }}"><div class='edit-content' >#</div></a>
        </div>
        @endif
        <h4 class="postdate">{{ date("l, F j", unixtime($post->created_at)) }}</h4>
        <h4 class="posttitle">{{ $post->posttitle }}</h4>
        <p class="postauthor">Posted by <b>{{ $post->author }}</b> on {{ date("D j M Y h:i:s A", unixtime($post->created_at)) }} GMT</p>
        <div class="postdsc">
            {!! $post->post !!}
        </div>
        @if(count($posts) > 1)
        <div class="margin">
            <img src="/img/ud_images/postdivider.png" />
        </div>
        @endif
    </div>
    @empty
    <div class='postContainer' id="post1"></div>
    @endforelse
    @if(count($posts) > 1)
    <div id='paginator'>
        {!! $posts->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
    </div>
    @endif
</div>