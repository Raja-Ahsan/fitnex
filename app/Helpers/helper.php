<?php

use App\Models\PageSetting;
use App\Models\Course;
use App\Models\Testimonial;
use App\Models\Category;

function globalData()
{
    $page_settings = PageSetting::get(['parent_slug', 'key', 'value']);
    $home_page_data = [];
    foreach ($page_settings as $key => $page_setting) {
        $home_page_data[$page_setting->key] = $page_setting->value;
    }
    return $home_page_data;
}

function courses($degree)
{
    return $courses = Course::where('degree_slug', $degree)->get(['degree_slug', 'title', 'slug']);
}

/* function testimonials()
{
    return $testimonials = Testimonial::where('status', '=', 1)->get();
} */



function gamecategorydata()
{
    return Category::where('status', 1)
        ->whereNotNull('id')
        ->whereNotNull('title')
        /* ->where('parent_id', 0) */
        ->get();
}


if (!function_exists('format_address')) {
    function format_address($address, $wordsPerLine = 10)
    {
        // Split the address into words
        $words = explode(' ', $address);

        // Chunk the words into groups of $wordsPerLine
        $lines = array_chunk($words, $wordsPerLine);

        // Join the chunks with <br> for line breaks
        return implode('<br>', array_map(function ($line) {
            return implode(' ', $line);
        }, $lines));
    }
}

if (!function_exists('formatFitnexText')) {
    function formatFitnexText($text) {
        if ($text) {
            $replacement = '<span class="italic uppercase font-black"><span class="primary-theme">FIT</span>NEX</span>';
            return str_replace('FITNEX', $replacement, $text);
        }
        return '';
    }
}
