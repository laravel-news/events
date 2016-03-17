<?php

return [

    'app_id' => env('ONESIGNAL_APP_ID',''),
    'api_key' => env('ONESIGNAL_API_KEY',''),
    'url' => env('ONESIGNAL_URL','https://onesignal.com/api/v1/notifications'),
    'icon_url' => env('ONESIGNAL_ICON_URL',''),
    'own_player_id' => env('ONESIGNAL_OWN_PLAYER_ID',''),
    'is_test' => env('ONESIGNAL_IS_TEST',1)
];