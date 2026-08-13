<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk upload image ke Cloudinary
    | Dapatkan credentials dari: https://cloudinary.com/console
    |
    */

    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    'api_key' => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),
    'secure' => env('CLOUDINARY_SECURE', true),
    
    // URL lengkap (opsional, jika tidak ingin set satu-satu)
    'url' => env('CLOUDINARY_URL'),
];
