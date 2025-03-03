<?php

return [
    'provider' => [
        // You can switch between different providers or configure multiple providers
        'name' => env('PAYMENT_PROVIDER', 'iyzico'),
        
        // Default API configuration 
        'api_url' => env('PAYMENT_API_URL', 'https://sandbox-api.example.com'),
        'client_id' => env('PAYMENT_CLIENT_ID', ''),
        'api_key' => env('PAYMENT_API_KEY', ''),
        'secret_key' => env('PAYMENT_SECRET_KEY', ''),
        'store_key' => env('PAYMENT_STORE_KEY', ''),
        
        // Sandbox mode
        'test_mode' => env('PAYMENT_TEST_MODE', true),
    ],
    
    // Iyzico specific configuration
    'iyzico' => [
        'api_url' => env('IYZICO_API_URL', 'https://sandbox-api.iyzipay.com'),
        'api_key' => env('IYZICO_API_KEY', ''),
        'secret_key' => env('IYZICO_SECRET_KEY', ''),
    ],
    
    // PayTR specific configuration
    'paytr' => [
        'merchant_id' => env('PAYTR_MERCHANT_ID', ''),
        'merchant_key' => env('PAYTR_MERCHANT_KEY', ''),
        'merchant_salt' => env('PAYTR_MERCHANT_SALT', ''),
    ],
    
    // Garanti specific configuration
    'garanti' => [
        'terminal_id' => env('GARANTI_TERMINAL_ID', ''),
        'merchant_id' => env('GARANTI_MERCHANT_ID', ''),
        'user_id' => env('GARANTI_USER_ID', ''),
        'password' => env('GARANTI_PASSWORD', ''),
    ],
];