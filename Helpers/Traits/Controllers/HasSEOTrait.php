<?php namespace Zix\Core\Helpers\Traits\Controllers;

use Zix\Core\Entities\Seo;

trait HasSEOTrait
{
    public function tools()
    {
        return app('seotools');
    }

    public function seo(Seo $seo)
    {
        $this->tools()->setTitle($seo->title);
        $this->tools()->setDescription($seo->description);
        $this->tools()->metatags()->setKeywords($seo->keywords);

    }
}