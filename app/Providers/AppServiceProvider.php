<?php

namespace App\Providers;

use App\Role;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('roles')) {
            $zam = Role::where('name', 'Заместитель')->first();
            view()->composer('admin.layouts.app',
                function ($view) use ($zam) {
                    $view->with('zam', $zam);
                });
        }
    }
}
