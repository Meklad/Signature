<?php

namespace Meklad\Signature;

use Illuminate\Support\ServiceProvider;

class SignatureEngineProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SignatureEngine::class, function () {
            return new SignatureEngine();
        });
    }

    public function boot()
    {
        //
    }
}
