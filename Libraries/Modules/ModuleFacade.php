<?php namespace Zix\Core\Libraries\Modules;

use Illuminate\Support\Facades\Facade;

/**
 * Class ModuleFacade
 * @package modules\Core\Libraries\Modules
 */
class ModuleFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'modules';
    }
}
