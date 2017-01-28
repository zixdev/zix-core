<?php namespace Zix\Core\Libraries\Sites\Traits;

use Illuminate\Support\Facades\Storage;

trait HasMultiSitesTrait
{
    public function getTheme()
    {
        return $this->name;
    }

    public function getThemeScripts($name, $build = null, $type = null, $ext = '.js')
    {
        $version = site()->uis()->enabled()->latest()->first()->version;

        $file = 'scripts/' . $this->ui . '/' . $version . '/' .$name;

        if($build) {
            $file .= '.' . $build;
        }

        if($type) {
            $file .= '.' . $type;
        }

        $file .= $ext;

        return Storage::get($file);
    }

    public function scripts()
    {
        return json_decode(site()->uis()->enabled()->latest()->first()->scripts);
    }

    public function activeUi()
    {
        return site()->uis()->enabled()->latest()->first();
    }

}