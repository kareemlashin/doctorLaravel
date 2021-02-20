<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class locationRequest extends FormRequest
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
            'country_ar' => 'required|string|max:50|min:2,unique:locations,country_ar',
            'country_en' => 'required|string|max:50|min:2,unique:locations,country_en',
            'city_en' => 'required|string|max:50|min:2,unique:locations,city_en',
            'code' => 'required|string|max:5|min:1,unique:locations,code',
            'key' => 'required|string|max:5|min:1,unique:locations,key',
        ];
    }
    public function messages()
    {
        return [
            'country_ar.required' => 'required country arabic ',
            'country_ar.string' => 'must be string ',
            'country_ar.max' => 'max 50',
            'country_ar.min' => 'min 2',
            'country_ar.unique' => 'country arabic  must be unique',

            'country_en.required' => 'required country english ',
            'country_en.string' => 'must be string ',
            'country_en.max' => 'max 50',
            'country_en.min' => 'min 2',
            'country_en.unique' => 'country english  must be unique',

            'city_en.required' => 'required city english ',
            'city_en.string' => 'must be string ',
            'city_en.max' => 'max 50',
            'city_en.min' => 'min 2',
            'city_en.unique' => 'city english  must be unique',

            'city_ar.required' => 'required city arabic ',
            'city_ar.string' => 'must be string ',
            'city_ar.max' => 'max 50',
            'city_ar.min' => 'min 2',
            'city_ar.unique' => 'city arabic  must be unique',

            'code.required' => 'required code  ',
            'code.string' => 'must be string ',
            'code.max' => 'code max 5',
            'code.min' => 'code min 1',
            'code.unique' => 'code must be unique',

            'key.required' => 'required key  ',
            'key.string' => 'key must be string ',
            'key.max' => 'key max 5',
            'key.min' => 'key min 1',
            'key.unique' => 'key   must be unique',


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
