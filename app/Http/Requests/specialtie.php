<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class specialtie extends FormRequest
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
            'specialties_ar' => 'required|string|max:100|min:2,unique:locations,specialties_ar',
            'specialties_en' => 'required|string|max:100|min:2,unique:locations,specialties_en',
            'description' => 'required|string|max:200|min:2',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ];
    }
    public function messages()
    {
        return [
            'specialties_ar.required' => 'required specialties arabic ',
            'specialties_ar.string' => 'must be string ',
            'specialties_ar.max' => 'max 100',
            'specialties_ar.min' => 'min 5',
            'specialties_ar.unique' => 'specialties arabic  must be unique',

            'specialties_en.required' => 'required country arabic ',
            'specialties_en.string' => 'must be string ',
            'specialties_en.max' => 'max 100',
            'specialties_en.min' => 'min 5',
            'specialties_en.unique' => 'specialties arabic  must be unique',

            'description.required' => 'required country arabic ',
            'description.string' => 'must be string ',
            'description.max' => 'max 100',
            'description.min' => 'min 5',

            'photo.required' => 'required image',
            'photo.image' => 'must be  image',
            'photo.mimes' => 'image must be jpg,jpeg,png',



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
