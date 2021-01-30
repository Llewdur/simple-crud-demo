<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $languages = Language::orderBy('name')->get();

        view()->share('languages', $languages);
    }
}
