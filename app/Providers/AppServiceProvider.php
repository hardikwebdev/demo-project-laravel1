<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer(['*'], function ($view) {
            if (Auth::check() && auth()->user()->userwallet) {
                $totalstacking_pool = auth()->user()->userwallet->crypto_wallet;
                $view->with('max_stack', $totalstacking_pool);

            }
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
    }
}
