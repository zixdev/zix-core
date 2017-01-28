<?php

namespace Zix\Core\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use Zix\Core\Events\User\UserRegistered;
use Zix\Core\Http\Requests\User\UserCreateRequest;
use Zix\Core\Http\Requests\User\UserUpdateRequest;
use Zix\Core\Support\Traits\ApiResponses;
use Zix\Core\Support\Traits\CrudControllerTrait;

/**
 * Class ManageUserController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Manage Users
 */
class ManageUserController
{
    use ApiResponses, CrudControllerTrait;


    /**
     * UserController constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get User
     * ### Required permission (can:view_users)
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->respondWithData($this->model->findOrfail($id));
    }

    /**
     * Create User
     * ### Required permission (can:create_users)
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->model->create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'email_active_code' => str_random(60)
        ]);

        // fire event user created.
        event(new UserRegistered($user));

        return $this->respondDataCreated($user);
    }

    /**
     * Update User
     * ### Required permission (can:update_users)
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        return $this->respondRequestAccepted($this->model->find($id)->update($request->all()));
    }

    /**
     * Get User Roles
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function roles($id)
    {
        return $this->respondWithData($this->model->with('roles')->find($id));
    }

    /**
     * Update User Roles
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoles(Request $request, $id)
    {
        $roles = collect();
        collect($request->get('roles'))->map(function ($role) use ($roles) {
            $roles->push($role['name']);
        });

        return $this->respondRequestAccepted($this->model->find($id)->syncRoles($roles->toArray()));
    }
}