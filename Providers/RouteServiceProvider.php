<?php

namespace Zix\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Zix\Core\Http\Controllers';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerSiteConfig();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    public function registerRoutes()
    {
        Route::group([
            'namespace' => $this->namespace,
            'prefix'    => env('API_PREFIX')
        ], function () {

            $files = File::files(__DIR__.'/../Http/Routes');

            foreach($files as $file) {
                File::getRequire($file);
            }
        });
    }

    private function registerSiteConfig()
    {
        if(!\App::runningInConsole() && site()) {
            site()->config->map(function($config){
                $key =  str_replace('_', '.', $config->key);
                $key = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
                config([$key => $config->value]);
            });

        }

    }



}
