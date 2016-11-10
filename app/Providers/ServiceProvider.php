<?php

namespace Keikaku\Providers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Keikaku\Contracts\Services\UserService;
use Keikaku\Services\DefaultUserService;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserService::class, function () {

            return new DefaultUserService(new BcryptHasher());
        });
    }
}
