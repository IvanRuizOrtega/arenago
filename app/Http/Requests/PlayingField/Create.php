<?php

namespace App\Http\Requests\PlayingField;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Src\Resources\Constants\Options;

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
            'name' => ['required', 'string', 'max:255'],
            'price_hour' => ['required', 'numeric', 'decimal:0,2', 'min:10000'],
            'type' => ['required', 'string', 'max:100', Rule::in(array_keys(Options::SPORT_CENTERS))],
            'covered' => ['required', 'string', 'max:100', Rule::in(array_keys(Options::YES_OR_NOT))],
        ];
    }
}
