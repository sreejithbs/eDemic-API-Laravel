<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
                    'email'   => 'required|string|email|max:255|unique:doctor_profiles',
                    'phone_number' => 'required|string',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name'   => 'required|string|max:255',
                    'phone_number' => 'required|string',
                ];
            }
            default: break;
        }
    }
}