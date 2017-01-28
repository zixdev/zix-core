<?php

namespace Zix\Core\Http\Requests\User;

use App\Http\Requests\Request;

class UserUpdateInfoRequest extends Request
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
            'first_name'        => 'min:3|max:255',
            'last_name'         => 'min:3|max:255',
            'phone_number'      => 'min:3|max:255',
            'mobile_number'     => 'min:3|max:255',
            'address_line_1'    => 'min:3|max:255',
            'address_line_2'    => 'min:3|max:255',
            'subrub'            => 'min:3|max:255',
            'post_code'         => 'min:3|max:255',
            'state'             => 'min:3|max:255',
            'country'           => 'min:3|max:255'
        ];
    }
}
