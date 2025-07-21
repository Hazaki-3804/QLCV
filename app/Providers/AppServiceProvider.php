<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        //
        DB::listen(function ($query) {
            Log::channel('query')->info('Query Time: ' . $query->time . ' ms; Query: ' . $query->sql . '; Bindings: ' . json_encode($query->bindings));
        });
    }
}
