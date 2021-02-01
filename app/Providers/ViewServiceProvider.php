<?php

namespace App\Providers;

use App\Http\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Interest;
use App\Models\Language;

class ViewServiceProvider extends ServiceProvider
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