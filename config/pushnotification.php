<?php
/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAR0u1TFs:APA91bGDhFPCUP3v5TWWC50Io4GjTJDV0ybmPShk5u-so8upEBmEqxD8iUHw-FgN4VwUhyTE2i9uxM6O5KZttc0ougfca9JSd_lKTN4CBYnprUoxLsUVJJdMrnmjBY-X01KIF4GD0WcN',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        // 'passPhrase' => 'secret', //Optional
        // 'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];