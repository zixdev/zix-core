<?php namespace Zix\Core\Helpers\Traits\Model;

/**
 * Class HasFiltrableTrait
 * @package Zix\Core\Helpers\Traits\Model
 */
trait HasFiltrableTrait
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeFiltrable($query)
    {
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->get('sort'));
            $query = $query->orderBy($sortCol, $sortDir);
        }

        if(request()->has('filter')) {
            $query = $this->getFilteredAction($query, request()->get('filter'));
        }

        if(request()->has('per_page')) {
            return $query->paginate(request()->get('per_page'));
        }

        return $query->get();
    }

    /**
     * @param $query
     */
    public function scopeUpdateAction($query)
    {
        switch (request()->get('action')) {
            case 'delete' :
                return $query->delete();
            case 'restore' :
                return $query->restore();
            case 'force-delete' :
                return $query->forceDelete();

        }
        return $query->delete();
    }

    /**
     * @param $query
     * @param $action
     * @return mixed
     */
    private function getFilteredAction($query, $action)
    {
        switch ($action) {
            case 'deleted' :
                return $query->onlyTrashed();

        }
        return $query;
    }
}