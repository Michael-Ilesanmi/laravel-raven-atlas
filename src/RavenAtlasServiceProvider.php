<?php

/*
 * This file is part of the Raven Atlas package.
 *
 * (c) Michael Ilesanmi - localdev <ioluwamichael@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Localdev\RavenAtlas;

use Illuminate\Support\ServiceProvider;

class RavenAtlasServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../resources/config/raven.php');

        $this->publishes([
            $config => config_path('raven.php')
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('ravenatlas', function ($app) {
            return new RavenAtlas($app->make("request"));
        });

        $this->app->alias('ravenatlas', "Localdev\RavenAtlas\RavenAtlas");
    }

    /**
    * Get the services provided by the provider
    *
    * @return array
    */
    public function provides()
    {
        return ['ravenatlas'];
    }
}
