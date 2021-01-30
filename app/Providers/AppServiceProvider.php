<?php

namespace App\Providers;

use App\Models\Interest;
use App\Models\Language;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        self::shareInterests();
        self::shareLanguages();
    }

    private static function shareInterests()
    {
        $interests = Interest::orderBy('name')->get();

        view()->share('interests', $interests);
    }

    private static function shareLanguages()
    {
        $languages = Language::orderBy('name')->get();

        view()->share('languages', $languages);
    }
}
