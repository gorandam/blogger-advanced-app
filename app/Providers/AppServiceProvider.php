<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Billing\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('shared.sidebar', function ($view) {
          $view->with('archives', \App\Post::archives()); //Here we bind $archives to view (shared.sidebar) every time when we render this view
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->singleton(Stripe::class, function() { // here we bind key (this represents Stripe class)to the container
        return new Stripe(config('services.stripe.secret'));// here we return Stripe instance and insert stripe key
      });
    }
}
