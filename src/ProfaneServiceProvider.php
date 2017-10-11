<?php

namespace LaravelProfane;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ProfaneServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/lang', 'laravel-profane');

        $this->publishes([
            __DIR__.'/lang' => resource_path('lang/vendor/laravel-profane'),
        ]);

        Validator::extend('profane', 'LaravelProfane\ProfaneValidator@validate', Lang::get('laravel-profane::validation.profane'));

        Validator::replacer('profane', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, $message);
        });
    }

    public function register()
    {
        // code...
    }
}
