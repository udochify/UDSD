<?php
    if(isset($ajaxCategory)) $ajaxCategory = ucfirst($ajaxCategory);
?>
@if($usertype == 'activeadmin')
<div id='new-tab' class='component-tab'>
    <a title='create' class='new-link' href="{{ route('blog.create') }}"><div class='new-content' >+</div></a>
</div>
@endif
<div id="blogContent" class="collection">
    <div class="welcomeTitle">{{ $ajaxCategory or 'Blog' }}</div>
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
        <div class="comments">
            <span class='comment-title comment-ajax-title'></span>
            <div class="commentAjax" id="post{{ $post->id }}Ajax">
            </div>
            <span class='comment-title'>Past Comments({{ $comments_count = count($comments[$post->id]) }})</span>
            @forelse($comments[$post->id] as $comment)
            @if($loop->first) 
            <div class='showed-comment'>
            @else
            <div class='hidden-comment'>
            @endif   
                <div class="pastcomment" id="inactive">
                    <p><span><b>{{ $comment->commenter }}</b>&nbsp;says:</span>{{ $comment->comment }}</p>
                    <p class="commentdate">on {{ date("D j M Y h:i:s A", unixtime($comment->created_at)) }} GMT</p>
                </div>
            </div>
            @empty
            @endforelse
            @if($comments_count > 1)
                <span class='show-comments'>Show more Comments({{ $comments_count-1 }})</span>
            @endif
        @include('partials.comment_form', ['id' => $post->id])
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