<?php

namespace Zix\Core\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zix\Core\Http\Requests\User\UserLoginRequest;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class LoginController
 * @package Zix\Core\Http\Controllers\Auth
 * @resource Authentication
 */
class LoginController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use ApiResponses, AuthenticatesUsers;

    /**
     * Login User.
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        // If the class is using the Throttles Login trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        // Send the response after the user was authenticated.
        if ($user = Auth::user()) {
            $this->clearLoginAttempts($request);

            // fire event new user logged in.


            // remove the old token.
            $user->tokens()->where('name', $request->header('User-Agent'))->delete();

            return $this->respondDataCreated([
                'token' => $user->createToken($request->header('User-Agent'))->accessToken,
                'user' => $user,
                'permissions'  => $user->getAllPermissions()
            ]);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if (!$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->respondUnauthorized(trans('auth.failed'));
    }

    /**
     * Logout User.
     * When User Logout We Will Log him out and destroy the token.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        if(! $request->user()) {
            return $this->respondWithData(true);
        }
        return $this->respondWithData($request->user()->tokens()->where('name', $request->header('User-Agent'))->delete());
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLockoutResponse($request)
    {
        $this->fireLockoutEvent($request);

        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = trans('auth.throttle', ['seconds' => $seconds]);

        return $this->respondBadRequest($message);
    }
}
