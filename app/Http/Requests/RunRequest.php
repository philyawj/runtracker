<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RunRequest extends FormRequest
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
            'date' => 'required|date_format:"m/d/Y"|after:-365 day',
            'miles' => 'required|numeric|max:150',
            'hours' => 'sometimes|nullable|numeric|max:23',
            'minutes' => 'sometimes|nullable|numeric',
            'seconds' => 'sometimes|nullable|numeric'
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
            'date.required' => 'A date is required.',
            'date.date_format'  => 'The date must be formated like 07/04/2019.',
            'date.after' => 'The date must be less than one year ago.',
            'hours.max' => 'Run hours must be 23 or less.',
            'hours.numeric' => 'Hours must be a number.',
            'minutes.numeric' => 'Minutes must be a number.',
            'seconds.numeric' => 'Seconds must be a number.'
        ];
    }
}
