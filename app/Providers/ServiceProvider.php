<?php

namespace Keikaku\Providers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Keikaku\Contracts\Services\CategoryService;
use Keikaku\Contracts\Services\CurrencyService;
use Keikaku\Contracts\Services\ProjectService;
use Keikaku\Contracts\Services\TaskService;
use Keikaku\Contracts\Services\UserService;
use Keikaku\Services\DefaultCategoryService;
use Keikaku\Services\DefaultCurrencyService;
use Keikaku\Services\DefaultProjectService;
use Keikaku\Services\DefaultTaskService;
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

        $this->app->singleton(ProjectService::class, function () {
            return new DefaultProjectService();
        });

        $this->app->singleton(CurrencyService::class, function () {
            return new DefaultCurrencyService();
        });

        $this->app->singleton(CategoryService::class, function () {
            return new DefaultCategoryService();
        });

        $this->app->singleton(TaskService::class, function () {
            return new DefaultTaskService();
        });
    }
}
