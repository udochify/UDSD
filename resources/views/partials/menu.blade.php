<div id="menu" style="display:{{ $showMenu }}">
    <!-- <a class="menu-icon" href="{{ getCurrentRoute(['showMenu'=>'none']) }}"><div id="closeMenu"><span>x</span></div></a> -->
    <a class="menu-icon" href="{{ route('refresh', ['showMenu'=>'none']) }}"><div id="closeMenu"><span>x</span></div></a>
    <ul>
        <a href="{{ route('home.index') }}"><li>Home</li></a>
        <a href="{{ route('page.open', ['name'=>'services']) }}"><li>Work</li></a>
        <a href="{{ route('page.open', ['name'=>'about']) }}"><li>About</li></a>
        <a href="{{ route('page.open', ['name'=>'contact']) }}"><li>Contact</li></a>
        <a href="#"><li>Login</li></a>
        <a href="{{ route('register') }}"><li>Signup</li></a>
    </ul>
</div>