<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\API\FailedValidateTrait;

class UserOtpRequest extends FormRequest
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
        $rules = [
            'phone_number' => 'required',
        ];

        if( ! $this->request->has('otp_code') ){
            // $rules += ['android_device_id' => 'required'];
            $rules += ['ios_device_id' => 'required_without:android_device_id'];
        } else{
            $rules += ['otp_code' => 'required|numeric|digits:6'];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ios_device_id.required_without' => 'Either Android device ID field or iOS device ID is required',
        ];
    }
}