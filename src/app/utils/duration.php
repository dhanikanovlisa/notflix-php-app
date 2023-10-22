<?php
function listofHour(){
    $minutes = [];
    for ($i = 0; $i < 25; $i++) {
        $minutes[] = $i;
    }
    return $minutes;
}

function listofMinutes(){
    $minutes = [];
    for ($i = 0; $i < 61; $i++) {
        $minutes[] = $i;
    }
    return $minutes;
}

function turnToHourAndMinute($minute){
    $hour = floor($minute / 60);
    $minute = $minute % 60;

    return [
        "hour" => $hour,
        "minute" => $minute,
    ];
}

function turnIntoMinute($hour, $minute){
    return $hour * 60 + $minute;
}