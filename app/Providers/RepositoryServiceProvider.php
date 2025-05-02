<?php

namespace App\Providers;

use App\Models\Member;
use App\Repositories\auth\AuthInterface;
use App\Repositories\auth\AuthRepository;
use App\Repositories\member\MemberInterface;
use App\Repositories\member\MemberRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
