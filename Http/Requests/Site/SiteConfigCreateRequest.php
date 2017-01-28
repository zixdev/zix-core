<?php

namespace Zix\Core\Http\Requests\Site;

use App\Http\Requests\Request;

class SiteConfigCreateRequest extends Request
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
            'key'       => 'required|unique|min:3|max:255',
            'value'     => 'required|min:3|max:255'
        ];
    }
}
