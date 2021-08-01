<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Setting;
use View;

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
        $settings = Setting::where('key', 'company_name')
                            ->orWhere('key', 'company_logo')
                            ->orWhere('key', 'company_favicon')
                            ->get();
        View::share('body_class', 'sidebar-mini');
        View::share('wrapper_class', 'wrapper');
        View::share('company_name', get_option($settings, 'company_name'));
        View::share('company_logo', get_option($settings, 'company_logo'));
        View::share('company_favicon', get_option($settings, 'company_favicon'));
    }
}
