<?php namespace Zix\Core\Libraries\Sites;

use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('sites', function() {
            return new Site();
        });

    }

}