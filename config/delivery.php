<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'parameters' => [
        'letter' => env('PRICE_PARCEL_LETTER'),
        'box' => env('PRICE_PARCEL_BOX'),
        'small' => env('PRICE_SIZE_SMALL'),
        'medium' => env('PRICE_SIZE_MEDIUM'),
        'large' => env('PRICE_SIZE_LARGE'),
        'ordinary' => env('PRICE_DELIVERY_TYPE_ORDINARY'),
        'international' => env('PRICE_DELIVERY_TYPE_INTERNATIONAL'),
        'ordinary' => env('PRICE_RECEIVE_TYPE_ORDINARY'),
        'ordered' => env('PRICE_RECEIVE_TYPE_ORDERED'),
        'large_letter' => env('PRICE_SIZE_LARGE_LETTER'),
    ]

];