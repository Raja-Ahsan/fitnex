<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimezoneHelper
{
    /**
     * Convert a datetime from user's timezone to server timezone (UTC)
     * 
     * @param string $dateTime Date and time string (e.g., "2025-12-15 20:00:00")
     * @param string $userTimezone User's timezone (e.g., "America/New_York")
     * @return Carbon
     */
    public static function userToServer($dateTime, $userTimezone)
    {
        return Carbon::parse($dateTime, $userTimezone)->setTimezone(config('app.timezone'));
    }

    /**
     * Convert a datetime from server timezone (UTC) to user's timezone
     * 
     * @param string|Carbon $dateTime Date and time in server timezone
     * @param string $userTimezone User's timezone (e.g., "America/New_York")
     * @return Carbon
     */
    public static function serverToUser($dateTime, $userTimezone)
    {
        $carbon = $dateTime instanceof Carbon ? $dateTime : Carbon::parse($dateTime);
        return $carbon->setTimezone($userTimezone);
    }

    /**
     * Format datetime in user's timezone
     * 
     * @param string|Carbon $dateTime Date and time in server timezone
     * @param string $userTimezone User's timezone
     * @param string $format Format string (default: 'M d, Y h:i A')
     * @return string
     */
    public static function formatInUserTimezone($dateTime, $userTimezone, $format = 'M d, Y h:i A')
    {
        $carbon = $dateTime instanceof Carbon ? $dateTime : Carbon::parse($dateTime);
        return $carbon->setTimezone($userTimezone)->format($format);
    }

    /**
     * Get time range in user's timezone
     * 
     * @param string|Carbon $startDateTime Start datetime in server timezone
     * @param int $durationMinutes Duration in minutes
     * @param string $userTimezone User's timezone
     * @return array ['start' => Carbon, 'end' => Carbon]
     */
    public static function getTimeRangeInUserTimezone($startDateTime, $durationMinutes, $userTimezone)
    {
        $start = $startDateTime instanceof Carbon ? $startDateTime : Carbon::parse($startDateTime);
        $startInUserTz = $start->setTimezone($userTimezone);
        $endInUserTz = $startInUserTz->copy()->addMinutes($durationMinutes);

        return [
            'start' => $startInUserTz,
            'end' => $endInUserTz,
            'display' => $startInUserTz->format('g:i A') . ' - ' . $endInUserTz->format('g:i A')
        ];
    }

    /**
     * Convert appointment time from user timezone to server timezone for storage
     * 
     * @param string $date Date string (Y-m-d)
     * @param string $time Time string (H:i)
     * @param string $userTimezone User's timezone
     * @return array ['date' => string, 'time' => string, 'datetime' => Carbon]
     */
    public static function convertAppointmentToServer($date, $time, $userTimezone)
    {
        // Combine date and time in user's timezone
        $userDateTime = Carbon::createFromFormat('Y-m-d H:i', "$date $time", $userTimezone);
        
        // Convert to server timezone
        $serverDateTime = $userDateTime->setTimezone(config('app.timezone'));

        return [
            'date' => $serverDateTime->format('Y-m-d'),
            'time' => $serverDateTime->format('H:i:s'),
            'datetime' => $serverDateTime
        ];
    }

    /**
     * Convert stored appointment time from server timezone to user timezone for display
     * 
     * @param string $date Date string (Y-m-d) in server timezone
     * @param string $time Time string (H:i:s) in server timezone
     * @param string $userTimezone User's timezone
     * @return array ['date' => string, 'time' => string, 'datetime' => Carbon]
     */
    public static function convertAppointmentToUser($date, $time, $userTimezone)
    {
        // Combine date and time in server timezone
        $serverDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$date $time", config('app.timezone'));
        
        // Convert to user's timezone
        $userDateTime = $serverDateTime->setTimezone($userTimezone);

        return [
            'date' => $userDateTime->format('Y-m-d'),
            'time' => $userDateTime->format('H:i:s'),
            'datetime' => $userDateTime
        ];
    }
}

