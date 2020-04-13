<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\API\FailedValidateTrait;

class PatientDiagnosedRequest extends FormRequest
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
            'disease_code' => 'required|max:4',
            'stage_code' => 'required|max:4',
            'diagnosed_date_time' => 'required|string',
            'location_logs' => 'present|array',
            'location_logs.*.date_time' => 'required|string',
            'location_logs.*.latitude' => 'required|string',
            'location_logs.*.longitude' => 'required|string',
            'suspected_users_id' => 'present|array',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'location_logs.*.date_time' => 'location log date time',
            'location_logs.*.latitude' => 'location log latitude',
            'location_logs.*.longitude' => 'location log longitude',
        ];
    }
}