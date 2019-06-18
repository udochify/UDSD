@extends('layouts.app')

@section('helper_functions')
    @include('code.functions')
@endsection

@section('main_content')
    <div id="blogContent" class="collection">
        @if(count($posts) > 0)
        <?php $post = $posts[0] ?>
        <div class='postContainer' id="newPost">
            @if($usertype == 'activeadmin')
            @include('partials.post_create_form')
            @endif
        </div>
        @endif
    </div>
@endsection