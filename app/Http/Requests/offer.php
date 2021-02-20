<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class offer extends FormRequest
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
            'name_ar' => 'required|string|max:100|min:10',
            'name_en' => 'required|string|max:100|min:10',
            'price' => 'required|numeric|between:10,100000',
            'description_ar' => 'required|string|max:100|min:25',
            'description_en' => 'required|string|max:100|min:25',

        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'required name arabic ',
            'name_ar.string' => 'name must be string ',
            'name_ar.max' => 'name max 100',
            'name_ar.min' => 'name min 5',

            'name_en.required' => 'required name  ',
            'name_en.string' => 'name must be string ',
            'name_en.max' => 'name max 100',
            'name_en.min' => 'name min 5',

            'price.required' => 'required price  ',
            'price.numeric' => 'price numeric  ',
            'price.between' => 'price between 10 to any',

            'description_en.required' => 'description required  ',
            'description_en.string' => 'description must be string ',
            'description_en.max' => 'description max 100',
            'description_en.min' => 'description min 50',

            'description_ar.required' => 'description  required ',
            'description_ar.string' => 'description must be string ',
            'description_ar.max' => 'description max 100',
            'description_ar.min' => 'description min 50',


        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                ['status' => false, 'message' => $validator->errors()],
                422
            )
        );
    }


}
