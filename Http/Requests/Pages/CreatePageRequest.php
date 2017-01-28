<?php

namespace Zix\Core\Http\Requests\Pages;

use App\Http\Requests\Request;

class CreatePageRequest extends Request
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
            'title' => 'required|min:3|max:255',
            'slug'  => 'required|min:3|max:255',
            'sites' => 'required',
            'content' => 'required',
        ];
    }
}
