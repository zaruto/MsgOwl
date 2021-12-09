<?php

return [

    'sender' =>  env('MSG_OWL_SENDER'),

    'urls' => [
        'otp' =>  env('MSG_OWL_OTP_URL', 'https://otp.msgowl.com'),
        'rest' =>  env('MSG_OWL_REST_URL', 'https://rest.msgowl.com'),
    ],

    'keys' => [
        'rest_key' =>  env('MSG_OWL_REST_KEY'),
        'otp_key' => env('MSG_OWL_OTP_KEY'),
    ],

    'notification' => [
        'active' => env('MSG_OWL_NOTIFICATION_ACTIVE',true),
        'threshold' => 50,
        'contact_number' => env('MSG_OWL_SMS_NUMBER'),
        'message' => env('MSG_OWL_SMS_MSG', 'Your MsgOwl balance is getting low'),
    ],


];
