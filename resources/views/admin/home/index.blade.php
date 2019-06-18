@extends('layouts.app')

@section('helper_functions')
    @include('code.functions')
@endsection

@section('main_content')
    <div id="blogContent" class="collection">
    <!-- <p class="navStatus"> home >> featured </p> -->
        <div class='postContainer' id="post{{ $post->id }}">
            <h4 class="postdate">{{ date("l, F j", unixtime($post->created_at)) }}</h4>
            <h4 class="posttitle">{{ $post->posttitle }}</h4>
            <p class="postauthor">Posted by <b>{{ $post->author }}</b> on {{ date("D j M Y h:i:s A", unixtime($post->created_at)) }} GMT</p>
            <div class="postdsc">
                <p>{{ $post->post }}</p>
            </div>
            <div class="comments">
            @forelse($comments[$post->id] as $comment)    
                <div class="pastcomment" id="inactive">
                    <p><span><b>{{ $comment->commenter }}</b>&nbsp;says:</span>{{ $comment->comment }}</p>
                    <p class="commentdate">on {{ date("D j M Y h:i:s A", unixtime($comment->created_at)) }} GMT</p>
                </div>

                <div class="commentAjax" id="post{{ $post->id }}Ajax">
                </div>
            @empty
            @endforelse
            </div>
            
        </div>
    </div>
@endsection