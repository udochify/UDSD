@extends('layouts.app')

@section('helper_functions')
    @include('code.functions')
@endsection

@section('main_content')
    @if($usertype == 'activeadmin')
        <div id="contactContent" class="collection">
            <div class='postContainer' id="contact">
                @include('partials.page_edit_form')
            </div>
        </div>
    @endif
@endsection