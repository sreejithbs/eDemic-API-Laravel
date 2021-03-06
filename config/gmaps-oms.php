<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google API Key
    |--------------------------------------------------------------------------
    |
    | A Google API key to link Google's API.
    |
    */
    'key' => env('GMAP_API_KEY', 'AIzaSyCGYP5VYQWWhuXkQarhsd_WezxNhVkgw64'),

    /*
    |--------------------------------------------------------------------------
    | Map Type
    |--------------------------------------------------------------------------
    |
    | Set the default Googlmapper displayed map type. (ROADMAP|SATELLITE|HYBRID|TERRAIN)
    |
    */
    'type' => 'ROADMAP',

    /*
    |--------------------------------------------------------------------------
    | Default Zoom
    |--------------------------------------------------------------------------
    |
    | The default zoom level Googlmapper should use.
    |
    */
    'zoom' => 15,

    /*
    |--------------------------------------------------------------------------
    | Marker Animation
    |--------------------------------------------------------------------------
    |
    | Display an animation effect for markers. (NONE|DROP|BOUNCE)
    |
    */
    'animation' => 'DROP',

    /*
    |--------------------------------------------------------------------------
    | Location Marker Icons
    |--------------------------------------------------------------------------
    |
    | Set the default map marker icons.
    |
    */
    'marker_icons' => [

        /*
        |--------------------------------------------------------------------------
        | Spiderfy Icon
        |--------------------------------------------------------------------------
        */
        'spiderfy' => 'images/pins/blue.png',

        /*
        |--------------------------------------------------------------------------
        | Risk Level 0 Icon
        |--------------------------------------------------------------------------
        */
        'risk_level_0' => '',

        /*
        |--------------------------------------------------------------------------
        | Risk Level 1 Icon
        |--------------------------------------------------------------------------
        */
        'risk_level_1' => 'images/pins/red.png',

        /*
        |--------------------------------------------------------------------------
        | Risk Level 2 Icon
        |--------------------------------------------------------------------------
        */
        'risk_level_2' => 'images/pins/orange.png',

        /*
        |--------------------------------------------------------------------------
        | Risk Level 3 Icon
        |--------------------------------------------------------------------------
        */
        'risk_level_3' => 'images/pins/yellow.png',
    ],

];