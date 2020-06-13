<?php

namespace App\Providers;

use App\QueryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(
            function ($query) {
                if (strpos($query->sql, 'query_log') !== false) {
                    return;
                }
//                Log::info('<br>');
//                Log::info([
//                    'sql' => $query->sql,
//                    'bindings' => implode(', ', $query->bindings),
//                    'time' => $query->time
//                ]);
//                Log::info('<br>');
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
