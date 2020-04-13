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