<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $currentPath = Request::path();

        $values = explode('/', $currentPath);

        $route = $values[0];

        view()->share('route', $route);
    }
}
