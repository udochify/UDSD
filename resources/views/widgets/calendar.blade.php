<div class="widget_calendar widget_parent"> 
	<div class="calendar_level_1 widget_level_1 widget_header">
        <p>Calendar</p>
        <div class="widget_option_btn" title="calendar options"></div>
    </div>
    <div class="widget_options widget_level_1">
    	<div class="ajax_select">
            {!! Form::open(['route' => 'calendar.index'], ['class' => 'form']) !!}
                {!! Form::select('month', $months, $month, ['class'=>'calendar_select select_mth']) !!}
                {!! Form::selectRange('year', 2000, 3000, $year, ['class'=>'calendar_select select_yr']) !!}
                <input type='hidden' name='day' value='' />
                <input type='hidden' name='showPosts' value='none' />
                <noscript>
                {!! Form::submit('OK',
                    [
                        'class' => 'btn btn-info btn-lg',
                    ])
                !!}
                </noscript>
            {!! Form::close() !!}
            <!-- <span class="option_text">Go&nbsp;to:&nbsp;</span> -->
        </div>
    </div>
    <div class="calendar_level_1 widget_level_1 widget_content">
        <div class='calendar_collection'>
            <div class="calRow cal_nav">
                <a href="{{ route('refresh', ['month'=>$month>1?$month-1:12, 'year'=>$month>1?$year:$year-1]) }}">
                    <div class="cal_nav_left calCol-1">
                        <span><</span>
                    </div>
                </a>
                <div class="cal_nav_text calCol-5"><span><noscript>{{ $months[$month] . " " . $year }}</noscript></span></div>
                <a href="{{ route('refresh', ['month'=>$month<12?$month+1:1, 'year'=>$month<12?$year:$year+1]) }}">
                    <div class="cal_nav_right calCol-1">
                        <span>></span>
                    </div>
                </a>
            </div>
            <div class="calRow cal_week">
                <div class="calCol-1">
                    <span>Su</span>
                </div>
                <div class="calCol-1">
                    <span>M</span>
                </div>
                <div class="calCol-1">
                    <span>Tu</span>
                </div>
                <div class="calCol-1">
                    <span>W</span>
                </div>
                <div class="calCol-1">
                    <span>Th</span>
                </div>
                <div class="calCol-1">
                    <span>F</span>
                </div>
                <div class="calCol-1">
                    <span>Sa</span>
                </div>
            </div>
            <div class="ajax_content ajax_content_calendar">
                @include('partials.calendar_index')
            </div>
        </div>
    </div>
    <div class="calendar_level_1 widget_level_1 widget_tail">
    </div>
</div>
