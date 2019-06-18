<?php
	function unixtime($mysqltime)
	{
		$datetime = explode(' ', $mysqltime);
		$date = explode('-', $datetime[0]);
		$time = explode(':', $datetime[1]);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		$hour = $time[0];
		$min = $time[1];
		$sec = $time[2];
		$timestamp = mktime($hour, $min, $sec, $month, $day, $year);
		return $timestamp;
	}

	function getDay($mysqltime)
	{
		$datetime = explode(' ', $mysqltime);
		$date = explode('-', $datetime[0]);
		$day = $date[2];
		return intval($day);
	}
	
	function getMonth($mysqltime)
	{
		$datetime = explode(' ', $mysqltime);
		$date = explode('-', $datetime[0]);
		$month = $date[1];
		return intval($month);
	}
	
	function getYear($mysqltime)
	{
		$datetime = explode(' ', $mysqltime);
		$date = explode('-', $datetime[0]);
		$year = $date[0];
		return intval($year);
	}
	
	function getCurrentRoute($parameters) 
	{
		return route(Route::currentRouteName(), array_merge(Route::current()->parameters(), $parameters));
	}
?>