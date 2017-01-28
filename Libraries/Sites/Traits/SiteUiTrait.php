<?php namespace Zix\Core\Libraries\Sites\Traits;


/**
 * Class SiteUiTrait
 * @package Zix\Core\Libraries\Sites\Traits
 */
trait SiteUiTrait
{
    public function addSiteVueUiScripts($ui_path)
    {
        $this->site->uis()->disable();

        $scripts = $this->storeUiVueScripts($ui_path);

        // create new site version.
        return $this->site->uis()->create([
            'scripts'           => $scripts->get('scripts'),
            'code_size'         => $scripts->get('code_size'),
            'assets_size'       => $scripts->get('code_size'),
            'version'           => $this->getNewUiVersion(),
            'type'              => 'vue',
            'html'              => $scripts->get('content')
        ]);
    }

    /**
     * @param $ui_path
     * @return mixed
     */
    public function addSiteAngularUiScripts($ui_path)
    {
        $this->site->uis()->disable();


        $scripts = $this->storeUiAngularScripts($ui_path);
        $this->storeUiAssets($ui_path);


        // create new site version.
        return $this->site->uis()->create([
            'scripts'       => $scripts->get('scripts'),
            'code_size'     => $scripts->get('code_size'),
            'assets_size'     => $scripts->get('code_size'),
            'version'       => $this->getNewUiVersion()
        ]);
    }

    /**
     * @return string
     */
    public function getNewUiVersion()
    {
        return increment_version(
            $this->site->uis()->count() ?
            $this->site->uis()->latest()->first()->version :
            '0.0.0'
        );
    }

    /**
     * @param $ui_path
     * @return Collection
     */
    private function storeUiAngularScripts($ui_path)
    {
        $size = 0;
        $scripts = collect();

        $files = \File::files($ui_path);

        foreach ($files as $file) {
            $name = \File::basename($file);
            $contents = \File::get($file);

            if (!str_contains($name, 'gz') && !str_contains($name, 'map') && (str_contains($name, 'main') || str_contains($name, 'styles') || str_contains($name, 'inline'))) {
                $size += \File::size($file);
                $scripts->push($name);
            }

            \Storage::put('scripts/' . $this->site->ui . '/' . $this->getNewUiVersion() . '/' . $name, $contents, 'public');
        }

        return collect([
            'scripts'   => $scripts,
            'code_size'      => get_human_file_size($size)
        ]);
    }

    public function storeUiVueScripts($ui_path)
    {
        $size = 0;
        $scripts = collect();

        $files = \File::files($ui_path. '/static/js');
        foreach ($files as $file) {
            $name = \File::basename($file);

            if (!str_contains($name, 'map')) {
                $size += \File::size($file);
                if(str_contains($name, 'app') || str_contains($name, 'manifest') || str_contains($name, 'vendor')) {
                    $scripts->push($name);
                }
            }
        }

        $content =  \File::get($ui_path.'/index.html');

        \File::copyDirectory($ui_path . '/static' , public_path('static'));
        \File::copyDirectory($ui_path . '/static' , storage_path('app/scripts/'. $this->site->ui . '/' . $this->getNewUiVersion() . '/static'));

        return collect([
            'scripts'           => $scripts,
            'code_size'         => get_human_file_size($size),
            'content'           => $content
        ]);
    }


    private function storeUiAssets($ui_path)
    {
        \File::copyDirectory($ui_path . '/assets/' . $this->site->ui, storage_path('app/scripts/'. $this->site->ui . '/' . $this->getNewUiVersion() . '/assets'));
        \File::copyDirectory($ui_path . '/assets/' . $this->site->ui, public_path('assets/'. $this->site->ui));
        \File::deleteDirectory($ui_path);
        return true;
    }
}