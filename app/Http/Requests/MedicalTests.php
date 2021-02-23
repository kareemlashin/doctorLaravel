<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MedicalTests extends FormRequest
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
            'name_ar' => 'required|string|max:100',
            'name_en' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.string' => 'name string ',
            'name_ar.required' => 'name required ',
            'name_ar.max' => 'name max 100 ',
            'image.required' => 'image required ',
            'image.image' => 'image must be image ',
            'image.mimes' => 'image must be jpg,jpeg,png ',
            'name_en.string' => 'name string ',
            'name_en.required' => 'name required ',
            'name_en.max' => 'name max 100 ',

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
