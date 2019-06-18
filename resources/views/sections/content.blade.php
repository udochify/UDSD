<div id="mainContent">
    <div id="sideNav">
        <div id="sideArchive">
            <a href="{{ getCurrentRoute(['currentFloater'=>'archive', 'showFloater'=>'block']) }}" title="Archive"><div class="overlay"></div></a>
            <img src="/img/ud_images/archive.png" alt="archive">
        </div>
        <div id="sideCalendar" title="Calendar">
            <a href="{{ getCurrentRoute(['currentFloater'=>'calendar', 'showFloater'=>'block']) }}"><div class="overlay"></div></a>
            <img src="/img/ud_images/date.png" alt="calendar">
        </div>
    </div>
    <div id="subNav">
        @include('sections.subnav')
    </div>
    <div id="content">
        <div id="contentBgTop">
            <img class="bkImgTop" src="/img/ud_images/contentBgTop.png" />
        </div>
        <div id="contentHtml">
            <div id="mcontent">
                @yield('main_content')
            </div>
        </div>
        <div id="contentBgBottom">
            <img class="bkImgBottom" src="/img/ud_images/contentBgBottom.png" />
        </div>
    </div>
</div>
<div id="sidebar">
    <div id="bar">
        <div id="barBgTop">
            <img class="sbkImgTop" src="/img/ud_images/sidebarTop.png" />
        </div>
        <div id="barHtml">
            <div id="scontent">
                <div id="widgets">
                    @include('widgets.archive')
                    @include('widgets.calendar')
                </div>
            </div>
        </div>
        <div id="barBgBottom">
            <img class="barImgTop" src="/img/ud_images/sidebarBottom.png" />
        </div>
    </div>
</div>
<div id="lastContent">
    @include('sections.footbar')
</div>
<div id="footer">
    @include('sections.footer')
</div>