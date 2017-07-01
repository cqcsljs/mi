<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
            'id'=>[
                'numeric',
            ],
            'img_id'=>[
                'numeric',
            ],
            'p_name'=>[
                'required'
            ],
            'model_id'=>[
                'numeric'
            ],
            'brand_id'=>[
                'numeric'
            ],
            'weight'=>[
                'numeric'
            ],
            ''
        ];
    }
}
