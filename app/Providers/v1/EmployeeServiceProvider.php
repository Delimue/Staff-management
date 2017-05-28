<?php

namespace App\Providers\v1;

use App\Services\v1;
use Illuminate\Support\ServiceProvider;

class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(EmployeeService::class, function($app){
            
            return new EmployeeService();
            
        });
    }
}
