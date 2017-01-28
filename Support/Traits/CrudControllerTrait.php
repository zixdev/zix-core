<?php namespace Zix\Core\Support\Traits;

use Illuminate\Http\Request;

/**
 * Class CrudControllerTrait
 * @package Zix\Core\Support\Traits
 */
trait CrudControllerTrait
{
    public function setPermissions($name)
    {
        $this->middleware("can:view_{$name}")->only('index');
        $this->middleware("can:view_{$name}")->only('show');
        $this->middleware("can:create_{$name}")->only('store');
        $this->middleware("can:update_{$name}")->only('update');
        $this->middleware("can:update_{$name}")->only('edit');
        $this->middleware("can:delete_{$name}")->only('delete');
    }
    /**
     * @var
     */
    protected $model;

    /**
     * Get Data
     * ### Required permission (can:view_model)
     * This will return dynamic filtrable data, (paginate, search, orderBy).
     * To get the deleted data use query(?eloquent=trashed)
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if($request->get('eloquent') == 'trashed')
        {
            return \Datatables::of($this->model->onlyTrashed())->make(true);
        }

        return \Datatables::of($this->model->query())->make(true);
    }

    /**
     * Get Model.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->respondWithData($this->model->findOrfail($id));
    }

    /**
     * Remove Data
     * ### Required permission (can:delete_model)
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->respondRequestAccepted($this->model->withTrashed()->where('id', $id)->updateAction());
    }

}