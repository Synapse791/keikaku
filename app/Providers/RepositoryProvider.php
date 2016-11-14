<?php

namespace Keikaku\Providers;

use Illuminate\Support\ServiceProvider;
use Keikaku\Contracts\Repository\CategoryRepository;
use Keikaku\Contracts\Repository\CurrencyRepository;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Repository\TaskRepository;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Repositories\DefaultCategoryRepository;
use Keikaku\Repositories\DefaultCurrencyRepository;
use Keikaku\Repositories\DefaultProjectRepository;
use Keikaku\Repositories\DefaultTaskRepository;
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

        $this->app->singleton(ProjectRepository::class, function () {
            return new DefaultProjectRepository();
        });

        $this->app->singleton(CurrencyRepository::class, function () {
            return new DefaultCurrencyRepository();
        });

        $this->app->singleton(CategoryRepository::class, function () {
            return new DefaultCategoryRepository();
        });

        $this->app->singleton(TaskRepository::class, function () {
            return new DefaultTaskRepository();
        });
    }
}
