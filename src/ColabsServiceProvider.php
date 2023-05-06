<?php

/**
 * @author Rendra 
 * @license MIT
 */

namespace Colabs;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ColabsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/colabs.php', 'colabs'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerDirectives();
        $this->publishes([
            __DIR__ . '/config/colabs.php' => config_path('colabs.php'),
            __DIR__ . '/Localization/lang/id' => lang_path('id'),
        ]);
    }

    /**
     * Register all directives
     *
     * @return void
     */
    public function registerDirectives()
    {
        $directives = require __DIR__.'/directives/directives.php';

        collect($directives)->each(function ($item, $key) {
            Blade::directive($key, $item);
        });
    }
}