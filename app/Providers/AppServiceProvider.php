<?php

namespace App\Providers;

use App\Models\Kategori;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('user.component.header', function ($view){
            $kategoriAll = Cache::remember('kategori_all', 60, function (){
                return Kategori::latest()->get();
            });

            $view->with('kategoriAll', $kategoriAll);
        });
    }
}
