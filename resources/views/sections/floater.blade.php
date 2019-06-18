<div id="floater" style="display:{{ $showFloater }}">
    <a class="floater-menu-icon" href="{{ getCurrentRoute(['showFloater'=>'none']) }}">
        <div id="floaterCloseMenu">
            <span>x</span>
        </div>
    </a>
    <div id="archiveFloater" style="display:{{ $showArchive }}">
        @include('widgets.archive')
    </div>
    <div id="calendarFloater" style="display:{{ $showCalendar }}">
        @include('widgets.calendar')
    </div>
</div>