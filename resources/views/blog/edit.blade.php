@extends('layouts.app')

@section('helper_functions')
    @include('code.functions')
@endsection

@section('main_content')
    <div id="blogContent" class="collection">
    <!-- <p class="navStatus"> home >> featured </p> -->
    @if(count($posts) > 0)
    <?php $post = $posts[0] ?>
    <div class='postContainer' id="post{{ $post->id }}">
        @if($usertype == 'activeadmin')
        <h4 class="postdate">{{ date("l, F j", unixtime($post->created_at)) }}</h4>
        <h4 class="posttitle">{{ $post->posttitle }}</h4>
        <p class="postauthor">Posted by <b>{{ $post->author }}</b> on {{ date("D j M Y h:i:s A", unixtime($post->created_at)) }} GMT</p>
        @include('partials.post_edit_form')
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
                    <div class='component-tab'>
                        <a title='delete' class='delete-link' href="{{ route('blog.comment.delete', ['id'=>$comment->id]) }}"><div class='delete-content' >-</div></a>
                    </div>
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
        @endif
    </div>
    @endif
    </div>
@endsection