<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Auth;
use App\Models\Setting;

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
                $totalstaking_pool = auth()->user()->userwallet->crypto_wallet;
                $view->with('max_stake', $totalstaking_pool);
                $minstakeamount = Setting::where('key','min_stackingpool_amount')->value('value');
                $view->with('min_stake', $minstakeamount);

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
