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
        } else if ($request->is('user/*') || $request->is('home')) {
            $guard = 'user';
        } else if($request->is('dokter/*') || $request->is('dokter')) {
            $guard = 'dokter';
            if($request->is('dokter/login') || $request->is('dokter/daftar')) {
                $guard = '';
            }
        } else {
            $guard = 'user';
        }
        // $guard = 'admisn';
        View::share('guard', $guard);
    }
}
