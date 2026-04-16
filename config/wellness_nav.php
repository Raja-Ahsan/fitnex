<?php

/**
 * Yahan manually categories mat likhein — list `categories` table se aati hai
 * (AppServiceProvider → View composer `layouts.website.header`, foreach se).
 *
 * `specialties` sirf tab use hoti hai jab DB mein koi active category na ho.
 */
return [
    'specialties' => [],
];
