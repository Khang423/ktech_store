<?php

namespace App\Providers;

use App\Models\Member;
use App\Repositories\auth\AuthInterface;
use App\Repositories\auth\AuthRepository;
use App\Repositories\banner\BannerInterface;
use App\Repositories\banner\BannerRepository;
use App\Repositories\brand\BrandInterface;
use App\Repositories\brand\BrandRepository;
use App\Repositories\cart\CartInterface;
use App\Repositories\cart\CartRepository;
use App\Repositories\categoryProduct\CategoryProductInterface;
use App\Repositories\categoryProduct\CategoryProductRepository;
use App\Repositories\member\MemberInterface;
use App\Repositories\member\MemberRepository;
use App\Repositories\product\ProductInterface;
use App\Repositories\product\ProductRepository;
use App\Repositories\role\RoleInterface;
use App\Repositories\role\RoleRepository;
use App\Repositories\supplier\SupplierRepository;
use App\Repositories\supplier\SupplierInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MemberInterface::class, MemberRepository::class);
        $this->app->singleton(AuthInterface::class, AuthRepository::class);
        $this->app->singleton(ProductInterface::class, ProductRepository::class);
        $this->app->singleton(BrandInterface::class, BrandRepository::class);
        $this->app->singleton(SupplierInterface::class, SupplierRepository::class);
        $this->app->singleton(CategoryProductInterface::class, CategoryProductRepository::class);
        $this->app->singleton(BannerInterface::class, BannerRepository::class);
        $this->app->singleton(RoleInterface::class,RoleRepository::class);
        $this->app->singleton(CartInterface::class,CartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
