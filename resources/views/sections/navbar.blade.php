<a id="blogNav" href="{{ route('home.index') }}">
    <div class="navBlock {{ $indexTab or ''}}" id="blog" >
        <span>Home</span>
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<a id="servicesNav" href="{{ route('blog.work') }}">
    <div class="navBlock {{ $servicesTab or '' }}" id="services" >
    	<span>Work</span>
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<a id="aboutNav" href="{{ route('page.open', ['name'=>'about']) }}">
    <div class="navBlock {{ $aboutTab or '' }}" id="about" >
    	<span>About</span>
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<a id="contactNav" href="{{ route('page.open', ['name'=>'contact']) }}">
    <div class="navBlock {{ $contactTab or '' }}" id="contact" >
        <span>Contact</span>
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<p id="loginBtn">
	<!-- @if ($loggedin)
		logout
	@else 
		login
    @endif -->
    <span>DASHBOARD</span>
</p> 
<div id="search">
    <div>
        <form action="blog.php" method="post" name="search">
            <input class="inputImg" id="searchIcon" type="image" src="/img/ud_images/searchIconBg.png" />
            <input class="txt" id="searchf" size="20" type="text" name="searchTxt" value="Custom Search" />
        </form> 
    </div>
</div>
@if (session('role') == 'admin')
<div id="role" class="administrator">
    <span>Role: Administrator</span>
</div>
@endif