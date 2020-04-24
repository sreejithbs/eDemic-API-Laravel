<?php

return [

    // General
    'general' => [
        array( 'code' => 1000, 'description' => 'API fields validation error' ),
        array( 'code' => 1001, 'description' => 'Unauthorized Access error' ),
        array( 'code' => 1002, 'description' => 'Eloquent Model not found error' ),
        array( 'code' => 1003, 'description' => 'Data mismatch error' ),
        array( 'code' => 1004, 'description' => 'No data error' ),

        // External services
        array( 'code' => 2000, 'description' => 'Twilio SMS Service error' ),
    ],

    // Disease Risk Level
    'disease_risk_level' => [
        array( 'code' => 3000, 'status' => 'None', 'color' => '' ),
        array( 'code' => 3001, 'status' => 'Level 1', 'color' => 'yellow' ),
        array( 'code' => 3002, 'status' => 'Level 2', 'color' => 'orange' ),
        array( 'code' => 3003, 'status' => 'Level 3', 'color' => 'red' ),
    ],

    // Disease Status
    'disease_stages' => [
        array( 'code' => 5001, 'status' => 'Infection' ),
        array( 'code' => 5002, 'status' => 'Recovered' ),
        array( 'code' => 5003, 'status' => 'Dead' ),
        array( 'code' => 5004, 'status' => 'Self Quarantine' ),
    ],

    // Diseases from DB. Starts at 6001
    // 'diseases' => [
    //     array( 'code' => 6001, 'name' => 'ABC' ),
    // ],
];