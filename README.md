# This is my package msgowl

[![Latest Version on Packagist](https://img.shields.io/packagist/v/loopcraft/msgowl.svg?style=flat-square)](https://packagist.org/packages/loopcraft/msgowl)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/loopcraft/msgowl/run-tests?label=tests)](https://github.com/loopcraft/msgowl/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/loopcraft/msgowl/Check%20&%20fix%20styling?label=code%20style)](https://github.com/loopcraft/msgowl/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/loopcraft/msgowl.svg?style=flat-square)](https://packagist.org/packages/loopcraft/msgowl)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://www.local.mv/wp-content/uploads/listing-uploads/logo/2020/01/LoopCraft_logo.png" width="419px" />](https://theloopcraft.com/)
## Installation

You can install the package via composer:

```bash
composer require loopcraft/msgowl
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="msgowl-config"
```

This is the contents of the published config file:

```php
return [
    'sender' =>  env('MSG_OWL_SENDER'), //required
    
    'urls' => [
        'otp' =>  env('MSG_OWL_OTP_URL', 'https://otp.msgowl.com'),
        'rest' =>  env('MSG_OWL_REST_URL', 'https://rest.msgowl.com'),
    ],
    
    'keys' => [
        'rest_key' =>  env('MSG_OWL_REST_KEY'),  //required
        'otp_key' => env('MSG_OWL_OTP_KEY'),  //required
    ],
    
    'notification' => [
        'active' => env('MSG_OWL_NOTIFICATION_ACTIVE', true),
        'threshold' => 50,
        'contact_number' => env('MSG_OWL_SMS_NUMBER'),  //required if notification active is true
        'message' => env('MSG_OWL_SMS_MSG', 'Your MsgOwl balance is getting low'), 
    ],

];
```

## Usage

```php
MsgOwl::sendMessage('body of sms needed to send','960123456,9603212...',);
```

## Testing

```bash
composer test
```



## Credits

- Write test
- Add OTP support
## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [loopcraft](https://github.com/loopcraft)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
