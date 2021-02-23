<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class patient extends FormRequest
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
            'name' => 'required|string|max:100|min:2,unique:User',
            'email' => 'required|email|max:100|min:15,unique:User',
            'gender_id' => 'required|in:9,10|numeric',
            'location_id' => 'required|numeric',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'birthday' => 'required|date|before:2010-01-01|after:1920-01-01',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png',

        ];
    }

    public function messages()
    {
        return [
            'birthday.required' => 'birthday required ',
            'birthday.before' => 'birthday your old',
            'birthday.date' => 'birthday date',
            'birthday.after' => 'birthday after 1920',
            'phone.required' => 'phone required ',
            'phone.regex' => 'write phone must be right',
            'gender_id.required' => 'gender required',
            'gender_id.numeric' => 'gender numeric',
            'gender_id.in' => 'gender male or female',
            'location_id.required' => 'location required',
            'location_id.numeric' => 'location numeric',
            'email.required' => 'email required',
            'email.email' => 'email email',
            'email.max' => 'email max 100',
            'email.min' => 'email min 10',
            'email.unique' => 'email unique',
            'name.required' => 'name required ',
            'name.string' => ' name string',
            'name.max' => 'name max 100',
            'name.min' => 'name min 2',
            'name.unique' => 'name unique ',
            'profile.image' => 'must be  image',
            'profile.mimes' => 'image must be jpg,jpeg,png',
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
