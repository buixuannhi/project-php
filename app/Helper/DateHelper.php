<?php

use Carbon\Carbon;

if (!function_exists('dateToSearch')) {
    function dateToSearch($date)
    {
        return date("Y-m-d H-i-s", strtotime($date));
    }
}

if (!function_exists('dateBlog')) {
    function dateBlog($date)
    {
        return date(' j F Y', strtotime($date));
    }
}

if (!function_exists('dateComment')) {
    function dateComment($date)
    {
        return date('j F Y g:i A', strtotime($date));
    }
}

if (!function_exists('countHours')) {
    function countHours($depart_date, $arrive_date)
    {
        if ($depart_date && $arrive_date) {
            $depart_date = Carbon::create($depart_date);

            $arrive_date = Carbon::create($arrive_date);

            $depart_date->toDateTimeString();

            $arrive_date->toDateTimeString();

            $hours = $arrive_date->diffInHours($depart_date);

            return $hours;
        }
    }
}
