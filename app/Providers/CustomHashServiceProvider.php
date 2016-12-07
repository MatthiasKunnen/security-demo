<?php

namespace App\Providers;

use App\libraries\CustomHasher;
use Illuminate\Support\ServiceProvider;

class CustomHashServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['hash'] = $this->app->share(function () {
            return new CustomHasher();
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('hash');
    }
}
