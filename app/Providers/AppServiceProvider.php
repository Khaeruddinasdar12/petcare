<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);
        $guard = '';
        if ($request->is('admin/*') || $request->is('admin')) {
            $guard = 'admin';
            if($request->is('admin/login')) {
                $guard = '';
            }
            $nav = '#4169E1';
        } else if ($request->is('user/*') || $request->is('home')) {
            $guard = 'user';
            $nav = '#5F9EA0';
        } else if($request->is('dokter/*') || $request->is('dokter')) {
            $guard = 'dokter';
            if($request->is('dokter/login') || $request->is('dokter/daftar')) {
                $guard = '';
            }
            $nav = '#A0522D';
        } else {
            $guard = 'user';
            $nav = '#5F9EA0';
        }
        // $guard = 'admisn';
        View::share('guard', $guard);
        View::share('navColor', $nav);
    }
}
