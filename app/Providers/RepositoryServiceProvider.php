<?php

namespace App\Providers;

use App\Models\Member;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
