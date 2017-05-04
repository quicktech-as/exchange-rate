<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Currency
    |--------------------------------------------------------------------------
    |
    | The application currency determines the default currency that will be
    | used by the ExchangeRate API.
    |
    */
    'default_currency' => env('EXCHANGERATE_DEFAULT_CURRENCY', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | API Key for exchangerate-api.com
    |--------------------------------------------------------------------------
    |
    | Only if you have a key of ExchangeRate API.
    |
    */
    'api_key' => env('EXCHANGERATE_API_KEY', ''),
    
    /*
    |--------------------------------------------------------------------------
    | API Uri for exchangerate-api.com
    |--------------------------------------------------------------------------
    |
    | Only if you have a key of ExchangeRate API.
    |
    */
    'api_uri' => env('EXCHANGERATE_API_URI', ''),
];