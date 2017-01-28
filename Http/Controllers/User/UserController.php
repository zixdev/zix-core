<?php

namespace Zix\Core\Http\Controllers\User;

use Illuminate\Http\Request;
use Zix\Core\Http\Requests\User\UserAvatarUpdateRequest;
use Zix\Core\Http\Requests\User\UserChangePasswordRequest;
use Zix\Core\Http\Requests\User\UserSelectAvatarRequest;
use Zix\Core\Http\Requests\User\UserUpdateInfoRequest;
use Zix\Core\Http\Requests\User\UserUpdateRequest;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class UserController
 * @package Zix\Core\Http\Controllers\User
 * @resource User
 */
class UserController
{
    use ApiResponses;

    /**
     * User
     * Get the logged in user with him all permissions.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return $this->respondWithData([
            'user' => $request->user(),
            'permissions' => $request->user()->getAllPermissions()
        ]);
    }


    /**
     * User Update
     * Update the logged in user detail.
     * if the user email been changed we will send him a confirmation link to
     * activate him new email.
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(UserUpdateRequest $request)
    {
        // if the user updated him email, he should activate it.
        if ($request->user()->email != $request->get('email')) {
            $request->user()->update([
                'email_active_code' => str_random(60),
                'email' => $request->get('email'),
                'username' => $request->get('username'),
                'email_active' => false
            ]);

            $request->user()->notify(new ActivateYourEmail($request->user()));

            return $this->respondWithData([
                'user' => $request->user(),
                'message' => 'We have sent you an email to confirm your new address Email'
            ]);

        }

        $request->user()->update($request->only([
            'email', 'username'
        ]));

        return $this->respondWithData([
            'user' => $request->user(),
            'message' => 'Your Account Was Successfully updated'
        ]);
    }


    /**
     * User Info
     * Get the logged in user infos.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request)
    {
        return $this->respondWithData([
            'user' => $request->user()->with('info')->first(),
            'email_active' => false
        ]);
    }

    /**
     * User Info Update
     * @param UserUpdateInfoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(UserUpdateInfoRequest $request)
    {
        if ($request->user()->info) {
            $request->user()->info->update($request->input());
        } else {
            $request->user()->info()->create($request->input());
        }

        return $this->respondWithData([
            'user' => $request->user()->with('info')->first()
        ]);
    }

    /**
     * User Password Update
     * @param UserChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(UserChangePasswordRequest $request)
    {
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json(
                ['current_password' => ['The current password you provided is incorrect.']], 422
            );
        }

        $request->user()->password = Hash::make($request->password);
        $request->user()->save();

        return $this->respondWithData([
            'message' => 'Your Password Been Updated!'
        ]);
    }

    /**
     * User Avatar Update
     * @param UserAvatarUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAvatar(UserAvatarUpdateRequest $request)
    {
        $image_url = $request->user()->addMedia($request->file('avatar'))->toCollection('images')->getUrl();
        $request->user()->update([
            'avatar' => url($image_url)
        ]);
        return $this->respondWithData([
            'user' => $request->user()
        ]);
    }

    /**
     * User Avatar Change
     * Logged in user can select an image from him Images
     * @param UserSelectAvatarRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectAvatar(UserSelectAvatarRequest $request)
    {
        $request->user()->update([
            'avatar' => $request->get('url')
        ]);
        return $this->respondWithData([
            'user' => $request->user()
        ]);
    }

    /**
     * User Images
     * Get all images been uploaded by this logged in user.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function images(Request $request)
    {
        // TODO:: get only images
        return $this->respondWithData([
            'images' => $request->user()->getMedia()->map(function ($image) {
                return [
                    'url' => url($image->getUrl()),
                    'name' => $image->file_name
                ];
            })
        ]);
    }

}