<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class posts extends FormRequest
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
            'tittle_ar' => 'required|string|max:100|min:10',
            'tag' => 'required',
            'title_en' => 'required|string|max:100|min:10',
            'description_ar' => 'required|string|min:25',
            'description_en' => 'required|string|min:25',
            'photo' => 'required|image|mimes:jpg,jpeg,png',

        ];
    }

    public function messages()
    {
        return [

            'photo.mimes' => 'photo must be jpg,jpeg,png',
            'photo.image' => 'photo must be  image',
            'photo.required' => ' required photo',

            'tittle_ar.required' => 'required tittle arabic ',
            'tittle_ar.string' => 'tittle must be string ',
            'tittle_ar.max' => 'tittle max 100',
            'tittle_ar.min' => 'tittle min 10',

            'title_en.required' => 'required title  ',
            'title_en.string' => 'title must be string ',
            'title_en.max' => 'title max 100',
            'title_en.min' => 'title min 10',

            'description_en.required' => 'description required  ',
            'description_en.string' => 'description must be string ',
            'description_en.min' => 'description min 25',

            'description_ar.required' => 'description  required ',
            'description_ar.string' => 'description must be string ',
            'description_ar.min' => 'description min 25',


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
