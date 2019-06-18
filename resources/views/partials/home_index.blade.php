<div id="blogContent" class="collection">
    <div class="welcomeTitle">Welcome Message</div>
    <div id="welcomeMsg">
        <p class="heading">Welcome to <span style="font-size: 25px;" class="logoTxt"><span class="bgi">ud</span>ShareDesk<span style="vertical-align: 17px" class="tm">TM</span></span>:</p>
        <p class="msg">Feel free to peruse the site and its features. At the present, most of the features you see here are still under development, so you might be seeing some changes (and definitely improvements) in the <b><i>layout</i></b>, <b><i>design</i></b>, and <b><i>programming</i></b> from time to time. So, feel free to check out what's new any time you get the chance... You're always welcomed.</p>
    </div>
@if($post != null)
    <div class="welcomeTitle">Featured Post</div>
    <div class='postContainer featured' id="post{{ $post->id }}">
        <h4 class="postdate">{{ date("l, F j", unixtime($post->created_at)) }}</h4>
        <h4 class="posttitle">{{ $post->posttitle }}</h4>
        <p class="postauthor">Posted by <b>{{ $post->author }}</b> on {{ date("D j M Y h:i:s A", unixtime($post->created_at)) }} GMT</p>
        <div class="postdsc">
            {!! $post->post !!}
            <div class='obscurer'></div>
        </div>
        <a class='show-post-link' href="{{ route('blog.show', ['blog'=>$post]) }}"><span class='show-post'>View Post in Blog<dt class='posttype' style='display:none'>{{ $post->posttype }}</dt></span></a>
    </div>
@endif  
</div>