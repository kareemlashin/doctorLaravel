<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class clinic extends FormRequest
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


            'tittle_ar' => 'required|string|max:100|min:5',
            'tittle_en' => 'required|string|max:100|min:5',
            'lat' => 'nullable|numeric',
            'lang' => 'nullable|numeric',
            'description_en' => 'required|string|max:250|min:10',
            'description_ar' => 'required|string|max:250|min:10',
            'address' => 'required|string|max:250|min:5',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpg,jpeg,png',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
        ];
    }
    public function messages()
    {
        return [

            'phone.required' => 'phone required',
            'phone.regex' => 'phone be 01******** ',

            'address.required' => 'address required',
            'address.string' => 'address be string ',
            'address.max' => 'address max 100',
            'address.min' => 'address min 5',

            'image.required' => 'image required',
            'image.array' => 'image array',

            'image.*.image'  => 'image image',
            'image.*.mimes' => 'image mimes jpg,jpeg,png',

            'lat.numeric' => 'lat numeric',
            'lang.numeric' => 'lang  numeric',


            'description_en.required' => 'description required',
            'description_en.string' => 'description be string ',
            'description_en.max' => 'description max 250',
            'description_en.min' => 'description min 10',


            'description_ar.required' => 'description required',
            'description_ar.string' => 'description be string ',
            'description_ar.max' => 'description max 250',
            'description_ar.min' => 'description min 10',

            'tittle_ar.required' => 'name required',
            'tittle_ar.string' => 'name be string ',
            'tittle_ar.max' => 'name max 100',
            'tittle_ar.min' => 'name min 5',

            'tittle_en.required' => 'name required',
            'tittle_en.string' => 'name be string ',
            'tittle_en.max' => 'name max 100',
            'tittle_en.min' => 'name min 5',
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
