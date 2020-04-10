<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class DiseaseRequest extends FormRequest
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
        switch( $this->method() )
        {
            case 'POST':
            {
                return [
                    'name'   => 'required|string|max:255',
                    'code' => 'required|string|max:8',
                    'risk_level' => 'required|numeric',
                    'password' => 'required|string|max:8',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name'   => 'required|string|max:255',
                    'risk_level' => 'required|numeric',
                ];
            }
            default: break;
        }
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if( $this->method() == 'POST'){
            $validator->after(function ($validator) {
                if ( ! Hash::check($this->password, $this->user()->password) ) {
                    $validator->errors()->add('password', 'Your Login password does not match our record.');
                }
            });
            return;
        }
    }
}