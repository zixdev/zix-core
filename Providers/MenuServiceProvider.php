<?php

namespace Zix\Core\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class MenuServiceProvider
 * @package Zix\Core\Providers
 */
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

    /**
     * Register App Menus
     */
    private function registerAppMenu()
    {
        \Zix\Core\Entities\Menu::all()->map(function ($menu_links) {
            \Menu::make($menu_links->name, function ($menu) use ($menu_links) {
                foreach (json_decode($menu_links->items) as $link) {
                    $parent = $menu->add($link->name, $link->url);
                    $this->updateMenuChildren($parent, $link);
                }
            });

        });

    }

    /**
     * @param $parent
     * @param $menu
     */
    private function updateMenuChildren($parent, $menu)
    {
        if (isset($menu->children) && count($menu->children)) {
            foreach ($menu->children as $link) {
                $child = $parent->add($link->name, $link->url);
                $this->updateMenuChildren($child, $link);
            }
        }
    }

}
