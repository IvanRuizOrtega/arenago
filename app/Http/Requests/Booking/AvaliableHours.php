<?php

namespace App\Http\Requests\Booking;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AvaliableHours extends FormRequest
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
            'date'  => [
                'required', 'date', 'after_or_equal:today',
                'before_or_equal:' . now()->addDays(3)->toDateString(),
            ],
            'open'  => ['required', 'date_format:H:i:s'],
            'close' => ['required', 'date_format:H:i:s', 'after:open'],
        ];
    }
}
