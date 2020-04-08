<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\API\FailedValidateTrait;

class DeviceTokenRequest extends FormRequest
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
            // 'android_device_token'   => 'required',
            'ios_device_token'   => 'required_without:android_device_token',
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
            'ios_device_token.required_without' => 'Either Android or iOS device token field is required',
        ];
    }
}