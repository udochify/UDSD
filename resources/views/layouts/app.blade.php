@yield('helper_functions')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	@include('sections.header')
</head>

<body>
    @include('partials.menu')
    @include('sections.floater')
    <div id="headerBg">
    </div>
    <div id="ctrlBoard"></div>
    <div id="dashboard">
        @if(session('role') == 'admin')
            @include('admin.sections.dashboard')
        @else
            @include('sections.dashboard')
        @endif
    </div>
    <div id="wrapper">
        <div id="logoBg">
            @include('sections.logo')
        </div>
        <div id="mainNav">
            @include('sections.navbar')
        </div>
        <div id="mainContentArea">
            @include('sections.content')
        </div>
    </div>
    <div id='routingTable'>
        @include('sections.routelinks')
    </div>
</body>
</html>