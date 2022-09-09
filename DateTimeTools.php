<?php

function createUnixTimestamp(int $year, int $month, int $day, int $hour, int $minute, int $second)
{
    $month_days_count = [
        'January' => 31,
        'February' => 29,
        'March' => 31,
        'April' => 30,
        'May' => 31,
        'June' => 30,
        'July ' => 31,
        'August' => 31,
        'September' => 30,
        'October' => 31,
        'November' => 30,
        'December' => 31
    ];
    $month_cumulative_count = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365];

    if(
        $year > 1969 &&
        checkdate($month, $day, $year) &&
        $hour > -1 && $hour < 24 &&
        $minute > -1 && $minute < 60 &&
        $second > -1 && $second < 60
    ){
        $years_count = $year - 1970;
        $leap_days_count = floor($years_count / 4);
        $days_count =
            ($years_count * 365) +
            $leap_days_count +
            $month_cumulative_count[$month - 1] +
            $day - 1 +
            (!($year % 4) && ($month > 2));
        $timestamp =
            ($days_count * 24 * 60 * 60) +
            ($hour * 60 * 60) +
            ($minute * 60) +
            $second;
        return $timestamp;
    }
    return 'date-time is invalid';
}
