<?php namespace Zix\Core\Helpers\Traits\Model;

use Zix\Core\Entities\Seo;

trait HasSeoTrait
{
    public function seo()
    {
        return $this->morphOne(Seo::class, 'model');
    }
}