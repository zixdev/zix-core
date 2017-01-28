<?php

namespace Zix\Core\Http\Requests\User;

use App\Http\Requests\Request;

class UserActivateEmailRequest extends Request
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
            'code'       => 'required|min:60|max:60'
        ];
    }
}
