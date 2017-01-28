<?php

namespace Zix\Core\Http\Requests\Contact;

use App\Http\Requests\Request;

class ContactReplyRequest extends Request
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
            'subject' => 'required|min:3|max:255',
            'message' => 'required'
        ];
    }
}
