<?php

namespace Keikaku\Providers;

use Illuminate\Support\ServiceProvider;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Repositories\DefaultUserRepository;

class RepositoryProvider extends ServiceProvider
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
        $this->app->singleton(UserRepository::class, function () {
            return new DefaultUserRepository();
        });
    }
}
