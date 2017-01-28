<?php

namespace Zix\Core\Http\Requests\User;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request
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
            'username'      => 'required|max:255|min:3|unique:users,id,'.$this->id,
            'email'         => 'required|email|max:255|min:3|unique:users,id,'.$this->id
        ];

    }
}
