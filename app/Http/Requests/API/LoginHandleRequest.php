<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\API\FailedValidateTrait;

class LoginHandleRequest extends FormRequest
{
    use FailedValidateTrait;

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
            'phone_number' => 'required',
            // 'android_device_token' => 'required',
            'ios_device_token' => 'required_without:android_device_token',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ios_device_token.required_without' => 'Either iOS device token field or Android device token is required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    // public function attributes()
    // {
    //     return [
    //         'phone_number' => 'Phone Number',
    //     ];
    // }
}