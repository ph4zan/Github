<?php 
$timezones = [
    'Moscow' => 'Europe/Moscow',
    'London' => 'Europe/London',
    'Tokyo' => 'Asia/Tokyo',
    'New York' => 'America/New_York'];

foreach($timezones as $city => $timezone) {
    $timezone = new DateTimeZone($timezone);
	$date = new DateTime();
    $modified = $date->setTimezone($timezone);
    echo $city .": ". $date->format('Y-m-d H:i'), "<br>";
}   