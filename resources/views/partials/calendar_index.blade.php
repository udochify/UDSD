<div class="calRow calDay">
@for($i = 0, $j = $startday; $i < $monthstart+$currentlastday || $i%7 != 0; $i++, $j++)
@if($i%7 == 0 && $i != 0)
</div>
<div class="calRow calDay">
@endif
    @if($i == $monthstart || $i == $monthstart+$currentlastday)
        <?php $j = 1 ?>
    @endif
    @if(isset($sortedPosts[$year][$month][$j]) && $i >= $monthstart && $i < $monthstart+$currentlastday)
        <?php
            $ishow = "none"; $active = "";
            if(intval($day) == $j)
            {
                $ishow = $showPosts;
            }
            $v = count($sortedPosts[$year][$month][$j]);
            $postday = 'postday';
            $postcount = strval($v) . ' post' . ($v>1?'s':'') . ' - click to view';
            $postHtmls[$j] = 
                "<div class='archive_level_3 calendar_post" . $j . "' style='display:" . $ishow . "'>"
                    ."<a href=\"" . route('refresh', ['day'=>$j, 'month'=>$month, 'year'=>$year, 'showPosts'=>'none', 'currentFloater'=>'calendar', 'showFloater'=>$showFloater]) . "\">"
                        ."<span class='close-menu'>x</span>"
                    ."</a>"
                ."</div>" 
                ."<ul style='display:" . $ishow . "' class='postday" . $j . "'>";
            foreach($sortedPosts[$year][$month][$j] as $post) 
            {
                $postHtmls[$j] .=
                "<li>"
                    ."<p>"
                        ."<a href=\"" . route('blog.show', ['blog'=> $post, 'day'=>$j, 'month'=>$month, 'year'=>$year, 'showPosts'=>'block',  'currentFloater'=>'calendar', 'showFloater'=>$showFloater]) . "\">"
                            ."<span class='arcTitle'>"
                                .$post->shorttitle
                            ."</span>"
                            ."<span class='posttype' style='display: none;'>" . $post->posttype . "</span>"
                        ."</a>"
                    ."</p>"
                ."</li>";
            }
            $postHtmls[$j] .= "</ul>";
        ?>
    @else
        <?php 
            $postday = '';
            $postcount = '';
        ?>
    @endif
    @if($i < $monthstart || $i >= $monthstart+$currentlastday)
        <?php $outday = 'outday' ?>
    @else
        <?php $outday = '' ?>
        @if($day == $j && $showPosts == 'block')
            <?php $active = 'active'; ?>
        @else
            <?php $active = '' ?>
        @endif
    @endif
            
    <a href="{{ route('refresh', ['day'=>$j, 'month'=>$month, 'year'=>$year, 'showPosts'=>'block']) }}">
        <div title="{{ $postcount }}" class="day calCol-1 {{ $outday }} {{ $postday }}wrapper {{ $active or '' }}">
            <span>{{ $j }}</span>
            <div class="aday {{ $postday }}"></div>
        </div>
    </a>
@endfor
</div>
<div class="archive_level_2 calendar-archive">
    @foreach($postHtmls as $postHtml)
        {!! $postHtml !!}
    @endforeach
</div>