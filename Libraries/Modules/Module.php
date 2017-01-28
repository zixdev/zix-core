<?php namespace Zix\Core\Libraries\Modules;

use Illuminate\Filesystem\Filesystem;
use Zix\Core\Libraries\Modules\Helpers\Packager;

/**
 * Class Module
 * @package Zix\Core\Libraries\Modules
 */
class Module
{
    /**
     * @var File
     */
    private $file;
    /**
     * @var Packager
     */
    private $packager;

    /**
     * Repository constructor.
     * @param Filesystem $file
     * @internal param null $path
     */
    public function __construct(Filesystem $file)
    {
        $this->file = $file;
    }


    /**
     * Get Module Package By Name.
     * @param $module
     * @return array
     */
    public function get($module)
    {
        return $this->all()->get($module);
    }

    /**
     * Get All Modules.
     * @return array
     */
    public function all()
    {
        $modules = [];

        foreach($this->scan() as $key => $module) {
            $package = new Packager($this->file);
            $modules[$package->set($module)->name()] = $package->set($module);
        }

        return collect(array_sort($modules, function($module) {
            return $module->config()->order;
        }));
    }

    /**
     * Get All Modules.
     * @return array
     */
    public function scan()
    {
        return $this->file->directories(base_path('modules'));
    }



}