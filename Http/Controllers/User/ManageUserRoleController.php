<?php

namespace Zix\Core\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Zix\Core\Entities\Permission;
use Zix\Core\Entities\Role;
use Zix\Core\Support\Traits\ApiResponses;
use Zix\Core\Support\Traits\CrudControllerTrait;

/**
 * Class ManageUserRoleController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Manage User Roles
 */
class ManageUserRoleController extends Controller
{

    use ApiResponses, CrudControllerTrait;
    /**
     * @var Permission
     */
    private $permission;


    /**
     * RoleController constructor.
     * @param Role $model
     * @param Permission $permission
     */
    public function __construct(Role $model, Permission $permission)
    {
        $this->model = $model;
        $this->permission = $permission;
    }

    /**
     * Create Role
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|min:3|max:255']);
        return $this->respondDataCreated($this->model->create($request->all()));
    }

    /**
     * Update Role
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $model = $this->model->find($id);
        $this->validate($request, ['name' => 'required|min:3|max:255|unique:roles,id,' . $model->id]);
        return $this->respondRequestAccepted($model->update($request->all()));
    }

    /**
     * Get Role Permissions
     * @return \Illuminate\Http\JsonResponse
     */
    public function permissions()
    {
        return $this->respondWithData($this->permission->all());
    }

    /**
     * Get Role For Edit
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->respondWithData($this->model->findOrfail($id));
    }

    /**
     * Get Role Permissions
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->respondWithData($this->model->with('permissions')->findOrfail($id));
    }

    /**
     * Update Role Permissions
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePermissions(Request $request, $id)
    {
        $role = $this->model->find($id);
        $role->permissions()->detach();
        collect($request->all())->filter(function ($permission) {
            return $permission;
        })->map(function ($permission, $key) use ($role, $request) {
            $role->givePermissionTo($key);
        });
        return $this->respondRequestAccepted($role->permissions);
    }
}