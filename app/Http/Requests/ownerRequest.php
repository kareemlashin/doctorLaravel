<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ownerRequest extends FormRequest
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
            'photo' => 'required|image|mimes:jpg,jpeg,png',
            'gender_en' => 'required|string|max:50|min:2,unique:gendes,gender_en',
            'gender_ar' => 'required|string|max:50|min:2,unique:gendes,gender_ar',
        ];
    }
    public function messages()
    {
        return [
            'photo.required' => 'required image',
            'photo.image' => 'must be  image',
            'photo.mimes' => 'image must be jpg,jpeg,png',

            'gender_en.required' => 'required gender english',
            'gender_en.string' => 'must bestring ',
            'gender_en.max' => 'max 50',
            'gender_en.min' => 'min 2',
            'gender_en.unique' => 'gender english  must be unique',

            'gender_ar.required' => 'required gender english',
            'gender_ar.string' => 'must bestring ',
            'gender_ar.max' => 'max 50',
            'gender_ar.min' => 'min 2',
            'gender_ar.unique' => 'gender arabic  must be unique',

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
