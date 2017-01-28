<?php namespace Zix\Core\Helpers\Traits\Model;

trait HasStatusTrait
{
    /**
     * Scope a query to only include enabled rows.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to only include disabled rows.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDisabled($query)
    {
        return $query->where('status', false);
    }

    /**
     * Scope a query to disable row.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDisable($query)
    {
        return $query->update(['status' => false]);
    }

    /**
     * Scope a query to enable row.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnable($query)
    {
        return $query->update(['status' => true]);
    }
}