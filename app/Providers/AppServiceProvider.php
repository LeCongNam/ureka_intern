<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Auth_Repo\AuthRepositoryInterface::class,
            \App\Repositories\Auth_Repo\AuthRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Dashboard\DashboardRepositoryInterface::class,
            \App\Repositories\Dashboard\DashboardRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Group_Member_Repo\GroupMemberRepositoryInterface::class,
            \App\Repositories\Group_Member_Repo\GroupMemberRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Product_Repo\ProductRepositoryInterface::class,
            \App\Repositories\Product_Repo\ProductRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Version_Repo\VersionRepositoryInterface::class,
            \App\Repositories\Version_Repo\VersionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
