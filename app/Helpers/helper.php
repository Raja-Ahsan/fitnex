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

if (!function_exists('upload_max_kb')) {
    function upload_max_kb(): int
    {
        return (int) config('upload.max_file_size_kb');
    }
}

if (!function_exists('upload_max_mb')) {
    function upload_max_mb(): string
    {
        return (string) config('upload.max_file_size_mb');
    }
}

if (!function_exists('upload_max_bytes')) {
    function upload_max_bytes(): int
    {
        return (int) config('upload.max_file_size_bytes');
    }
}

if (!function_exists('upload_file_rule')) {
    /** Laravel file validation: max size in KB from .env */
    function upload_file_rule(): string
    {
        return 'max:' . upload_max_kb();
    }
}

if (!function_exists('upload_too_large_message')) {
    function upload_too_large_message(): string
    {
        return (string) config('upload.too_large_message');
    }
}

if (!function_exists('upload_allowed_mimes')) {
    function upload_allowed_mimes(): string
    {
        return (string) config('upload.allowed_mimes');
    }
}
