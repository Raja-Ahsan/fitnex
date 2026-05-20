<?php

// Value comes only from .env (UPLOAD_MAX_FILE_SIZE_KB) — no hardcoded default here.
$maxKb = max(1, (int) env('UPLOAD_MAX_FILE_SIZE_KB'));
$maxMb = $maxKb % 1024 === 0
    ? (string) (int) ($maxKb / 1024)
    : (string) round($maxKb / 1024, 1);

return [

    /*
    |--------------------------------------------------------------------------
    | Upload limits (single source: .env UPLOAD_MAX_FILE_SIZE_KB)
    |--------------------------------------------------------------------------
    | Change only UPLOAD_MAX_FILE_SIZE_KB in .env — then run: php artisan config:clear
    | Laravel "max" rule for files uses kilobytes (set in .env, e.g. 10240 = 10 MB).
    */
    'max_file_size_kb' => $maxKb,
    'max_file_size_mb' => $maxMb,
    'max_file_size_bytes' => $maxKb * 1024,
    'allowed_mimes' => env('UPLOAD_ALLOWED_MIMES', 'jpeg,jpg,png,gif,webp,svg,ico'),
    'too_large_message' => "File size must not exceed {$maxMb} MB.",
    'file_max_exceeded_message' => "Each file must not exceed {$maxMb} MB.",

];
