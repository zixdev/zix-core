<?php namespace Zix\Core\Libraries\Sites;

use Illuminate\Support\Facades\Facade;

/**
 * Class SiteFacade
 * @package Zix\Core\Libraries\Sites
 */
class SiteFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sites';
    }
}
