<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}