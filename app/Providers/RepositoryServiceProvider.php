<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(
            'App\Services\Contracts\BranchInterface',
            'App\Repositories\BranchRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\MainSettingInterface',
            'App\Repositories\MainSettingRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\AboutCounterInterface',
            'App\Repositories\AboutCounterRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\SliderInterface',
            'App\Repositories\SliderRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\BrandInterface',
            'App\Repositories\BrandRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\TypeInterface',
            'App\Repositories\TypeRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\TagInterface',
            'App\Repositories\TagRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\SectionInterface',
            'App\Repositories\SectionRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\CategoryInterface',
            'App\Repositories\CategoryRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\ProductInterface',
            'App\Repositories\ProductRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\ManagerInterface',
            'App\Repositories\ManagerRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\CouponInterface',
            'App\Repositories\CouponRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\CartInterface',
            'App\Repositories\CartRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\OrderInterface',
            'App\Repositories\OrderRepository'
        );
        $this->app->bind(
            'App\Services\Contracts\AdminUserInterface',
            'App\Repositories\AdminUserRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
