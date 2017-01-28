<?php namespace Zix\Core\Libraries\Modules\Helpers;

use Illuminate\Filesystem\Filesystem;
use Zix\Core\Libraries\Modules\Contracts\PackagerInterface;

class Packager  implements PackagerInterface
{
    /**
     * @var
     */
    protected $module;

    /**
     * @var
     */
    private $file;

    /**
     * Packager constructor.
     * @param Filesystem $file
     */
    public function __construct(Filesystem $file)
    {
        $this->file = $file;
    }


    public function set($module)
    {
        $this->module = $module;
        return $this;
    }

    public function enable()
    {
        // TODO: Implement enable() method.
    }

    public function disable()
    {
        // TODO: Implement disable() method.
    }

    public function config()
    {
        return json_decode($this->file->get($this->module.'/config.json'));
    }

    public function version()
    {
        return $this->config()->version;
    }


    public function enabled()
    {
        return $this->config()->enable;
    }

    public function providers()
    {
        return $this->config()->providers;
    }

    public function path()
    {
        return (string) $this->module;
    }

    public function name()
    {
        return $this->config()->name;
    }


    public function getExtraPath($extra)
    {
        return $this->path()."/".$extra;
    }
}