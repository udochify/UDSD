@yield('helper_functions')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	@include('sections.header')
</head>

<body class="yui-skin-sam">
    <div id="headerBg">
    </div>
    @if(session('role') == 'admin')
        @include('admin.sections.dashboard')
    @else
        @include('sections.dashboard')
    @endif
    <div id="wrapper">
        <div id="header">
            <img class="logoImg" src="/img/ud_images/logoMentalRender.png" width="550" height="110" />
        </div>
	    <div id="mainContent">
	    	<div id="mainNav">
				@include('sections.navbar')
            </div>
            <div id="shadow">
            </div>
            <div id="mainContentArea">
                <div id="content">
                    <div id="subNav">
                        @include('sections.subnav')
                    </div>
                    <div id="mkGround0">
                    	<img class="bkImgTop" width="602" height="225" src="/img/ud_images/contentBgTop.png" />
                    </div>
                    <div id="mkGround1">
                        <div id="control">
                            <div id="controlUp">
                            </div>
                            <div id="controlDown">
                            </div>
                       	</div>
                    </div>
                    <div id="mcontent">
                        @yield('main_content')
					</div>
                </div>
                <div id="mkGround2">
                    <img class="bkImgBottom" width="602" height="202" src="/img/ud_images/contentBgBottom.png" />
                </div>
               	<div id="lastContent">
					@include('sections.footbar')
				</div>
            </div>
            <div id="sideBars">
				@include('sections.sidebars')
			</div>
        </div>
        <div id="footer">
			@include('sections.footer')
        </div>
    </div>
</body>
</html>