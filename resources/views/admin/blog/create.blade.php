@extends('layouts.app')

@section('helper_functions')
    @include('code.functions')
@endsection

@section('main_content')
    @if($usertype == 'activeadmin')
    <div id='new-tab' class='component-tab'>
        <a class='new-link' href='new-post'><div class='new-content' >+</div></a>
    </div>
    @endif
    <div id="blogContent" class="collection">

        <!-- <div class='postContainer' id="post{{ $post->id }}">
            
            <h4 class="posttitle">{{ $post->posttitle }}</h4>
            <div class="postdsc">
                <p>{{ $post->shortpost }}</p>
            </div>
            
        </div> -->

        @include('partials.new_post_form', ['id'=>$post->id])
    </div>
@endsection