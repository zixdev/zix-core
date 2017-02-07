<?php namespace Zix\Core\Libraries\Zexus;

use Illuminate\Support\ServiceProvider;

class ZexusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('zexus', function() {
            return new Zexus();
        });

    }
}