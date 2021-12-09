<?php

namespace Loopcraft\MsgOwl;

use Loopcraft\MsgOwl\Clients\OTPClient;
use Loopcraft\MsgOwl\Clients\RestClient;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MsgOwlServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('msgowl')->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->singleton('msgowl', MsgOwl::class);

        $this->app->singleton(RestClient::class, function ($app) {
            return new RestClient([
                'base_uri' => config('msgowl.urls.rest'),
                'headers' => [
                    'Authorization' => 'AccessKey '.config('msgowl.keys.rest_key'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
        });

        $this->app->singleton(OTPClient::class, function ($app) {
            return new OTPClient([
                'base_uri' => config('msgowl.urls.otp'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'AccessKey '.config('msgowl.keys.otp_key'),
                ],
            ]);
        });
    }
}
