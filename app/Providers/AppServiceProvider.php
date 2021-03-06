<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
 use Illuminate\Database\Schema\Builder;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // Import Builder where defaultStringLength method is defined

public function boot()
{
    Builder::defaultStringLength(191); // Update defaultStringLength
}
}
