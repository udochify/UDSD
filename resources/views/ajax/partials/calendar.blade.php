<?php

    if(isset($_GET['month'])) $month = $_GET['month'];
    if(isset($_GET['year'])) $year = $_GET['year'];
    $timestamp = mktime (0, 0, 0, $month, 1, $year); //timestamp for today
    $monthname = date('F', $timestamp); //month specifier: January to December
    $monthstart = date('w', $timestamp); //day specifier: 0 to 6
    $previouslastday = date('d', mktime (0, 0, 0, $month, 0, $year)); //last day of previous month: 01 to 31
    $currentlastday = date('d', mktime (0, 0, 0, $month+1, 0, $year)); //last day of current month: 01 to 31
    $startdate = -$monthstart;
    $startday = $previouslastday-$monthstart+1;

    //Figure out how many rows we need.
    //$numrows = ceil (((date("t", mktime (0, 0, 0, $month + 1, 0, $year)) + $monthstart) / 7)); //(t) number of days in a given month
?>
        
<div class="calRow calDay">
@for($i = 0, $j = $startday; $i < $monthstart+$currentlastday || $i%7 != 0; $i++, $j++)
@if($i%7 == 0 && $i != 0)
</div>
<div class="calRow calDay">
@endif
<div class="day">
    <span>
    @if($i == $monthstart || $i == $monthstart+$currentlastday)
        <?php $j = 1; ?>
    @endif
    {{ $j }}
    </span>
</div>
@endfor
</div>
<!-- </div> -->
