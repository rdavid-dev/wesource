<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserUpdateRequest extends FormRequest
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
            'name' => [
                'string',
                'required'
            ],
            'email' => [
                'string',
                'email',
                Rule::unique('users')->ignore($this->user->id)
            ],
            'address' => [
                'string',
                'required'
            ],
            'phone_number' => [
                'string',
                'required'
            ],
            'fb_username' => [
                'nullable'
            ]
        ];
    }

    /**
     * Ovveride this function to return json response
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()->all()], 422);

        throw new ValidationException($validator, $response);
    }
}
