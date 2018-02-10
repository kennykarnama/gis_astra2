<?php

namespace App\Providers;

use Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Queue\Events\JobProcessed;
use App\Events\ImportLaporanEvent;
use App\Jobs\ImportToDbJob;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        // Queue::after(function ($connection, $job, $data) {
        //     //
        //      var_dump($data);
        //     exit;
        // });

        
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
