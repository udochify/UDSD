<a href="{{ route('home.index') }}">
    <div class="navBlock" id="blog{{ $indexTab or ''}}" >
        Home
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<a href="{{ route('services.index') }}">
    <div class="navBlock" id="services{{ $servicesTab or '' }}" >
    	Work
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<a href="{{ route('about.index') }}">
    <div class="navBlock" id="about{{ $aboutTab or '' }}" >
    	About
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<a href="{{ route('contact.index') }}">
    <div class="navBlock" id="contact{{ $contactTab or '' }}" >
        Contact
    </div>
</a>
<div class="spacer"><img width="1" height="45" src="/img/ud_images/navSpacer.png" /></div>
<p id="loginBtn">
	@if ($loggedin)
		logout
	@else 
		login
	@endif
</p> 
<div id="search">
    <div>
        <form action="blog.php" method="post" name="search">
            <input class="inputImg" id="searchIcon" type="image" src="/img/ud_images/searchIconBg.png" />
            <input class="txt" id="searchf" size="20" type="text" name="searchTxt" value="Custom Search" />
        </form> 
    </div>
</div>