<?php

namespace Zix\Core\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;
use Zix\Core\Notifications\User\SetNewPassword;
use Zix\Core\Events\User\UserRegistered;

/**
 * Class SocialController
 * @package Zix\Core\Http\Controllers\Auth
 * @resource Authentication
 */
class SocialController
{
    /**
     * @var User
     */
    private $user;

    /**
     * SocialController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Login With Social Sites
     * (facebook/twitter/github)
     *
     * @param $type (facebook/twitter/github)
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($type)
    {
        return Socialite::driver($type)->redirect();
    }

    /**
     * Login With Social Sites Feedback
     * @param Request $request
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request, $type)
    {
        $user = Socialite::driver($type)->user();

        // check if we don't have any user with that email
        // if so redirect to forgot password
        if ($existing_user = $this->user->where('email', $user->email)->first()) {
            // log him in, if the token much the store token
            if ($existing_user->social()->where('type', $type)->where('token', $user->token)->first()) {
                // redirect to the front end logger
                return redirect()->to(url('auth/indent-login?token=' . $existing_user->createToken($type)->accessToken));
            }

            return redirect()->to(url('auth/forgot-password?email=' . $user->email));
        }

        // create new user
        // set tmp password
        $password = str_random(8);

        // redirect to front-end to set new user also mail that link.

        $new_user = $this->user->create([
            'username' => $user->getNickname(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),
            'password' => bcrypt($password),
            'active_code' => $user->token, // tmp
            'email_active' => true,
        ]);

        // TODO:: Update user info
        $new_user->social()->create([
            'type' => $type,
            'token' => $user->token,
            'email' => $user->getEmail()
        ]);

        // store the socialite token and name

        // notify the user to set him new password.
//        $user->notify(new SetNewPassword($user, $password));
        return redirect()->to(url('auth/indent-login?setPassword=' . $password . '&token=' . $new_user->createToken($type)->accessToken));
    }


}