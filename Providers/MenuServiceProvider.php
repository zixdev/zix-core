<?php

namespace Zix\Core\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\App::runningInConsole() && site()) {
            $this->registerAppMenu();
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function registerAppMenu()
    {
        \Zix\Core\Entities\Menu::all()->map(function($menu_links) {
            \Menu::make($menu_links->name, function($menu) use ($menu_links) {
                $menu_links->links->map(function($link) use ($menu) {
                    $a = $menu->add($link->name, $link->url);
                    if($link->childrens()->count()) {
                        $link->childrens->map(function($child) use ($a){
                            $a->add($child->name, $child->url);
                        });
                    }
                });
            });

        });

    }

}
