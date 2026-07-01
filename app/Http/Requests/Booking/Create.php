<?php

namespace App\Http\Requests\Booking;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'playing_field_id' => [
                'required',
                'integer',
                'exists:playing_fields,id'
            ],
            'start_time' => [
                'required',
                'date_format:Y-m-d H:i:s',
            ],
            'duration_hours' => [
                'required',
                'integer',
                'in:1,2'
            ],
        ];
    }
}
