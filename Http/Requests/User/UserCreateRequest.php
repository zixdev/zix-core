<?php

namespace Zix\Core\Http\Requests\User;

use App\Http\Requests\Request;

class UserCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'      => 'required|unique:users|max:255|min:3',
            'email'         => 'required|unique:users|email|max:255|min:3',
            'password'      => 'required|confirmed|max:255|min:6',
            'accept_terms'  => 'required|accepted'
        ];
    }
}
