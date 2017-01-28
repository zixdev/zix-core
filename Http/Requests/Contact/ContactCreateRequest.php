<?php

namespace Zix\Core\Http\Requests\Contact;

use App\Http\Requests\Request;

class ContactCreateRequest extends Request
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
            'name'                  => 'required|min:3|max:255',
            'phone'                 => 'required|min:3|max:255',
            'email'                 => 'required|email',
            'address'               => 'required|min:3|max:255',
            'message'               => 'required|min:30',
            'g-recaptcha-response'  => 'required|recaptcha'
        ];
    }
}
