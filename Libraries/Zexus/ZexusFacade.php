<?php namespace Zix\Core\Libraries\Zexus;

use Illuminate\Support\Facades\Facade;

class ZexusFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zexus';
    }
}
