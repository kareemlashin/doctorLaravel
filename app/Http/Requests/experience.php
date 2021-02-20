<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class experience extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name_ar' => 'array',
            'name_en' => 'array',
            'start_date' => 'array',
            'end_date' => 'array',
            'description_en' => 'array',
            'description_ar' => 'array',

            'name_ar.*' => 'required|string|max:100|min:5',
            'name_en.*' => 'required|string|max:100|min:5',
            'start_date.*' => 'required|date|before:today',
            'end_date.*' => 'required|date|after_or_equal:start_date.*',
            'description_en.*' => 'required|string|max:250|min:10',
            'description_ar.*' => 'required|string|max:250|min:10',
        ];
    }
    public function messages()
    {
        return [
            'start_date.*.required' => 'start date required',
            'start_date.*.date' => 'start date be date ',
            'start_date.*.before' => 'start date must be before this date ',

            'end_date.*.required' => 'end date date required',
            'end_date.*.date' => 'end date be date ',
            'end_date.*.after_or_equal' => 'end date must be after start date ',

            'name_ar.*.required' => 'name required',
            'name_ar.*.string' => 'name be string ',
            'name_ar.*.max' => 'name max 100',
            'name_ar.*.min' => 'name min 5',

            'name_en.*.required' => 'name required',
            'name_en.*.string' => 'name be string ',
            'name_en.*.max' => 'name max 100',
            'name_en.*.min' => 'name min 5',
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
