<?php

namespace App\Http\Requests\PQRS;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:petition,complaint,claim,suggestion,improvement_idea,ranking',

            // El ranking es obligatorio solo si el tipo es 'ranking'
            'ranking' => 'required_if:type,ranking|nullable|integer|between:1,5',

            // La idea es obligatoria si el tipo es 'improvement_idea'
            'improvement_idea' => 'required_if:type,improvement_idea|nullable|string',

            // Sujeto y mensaje suelen ser obligatorios para PQRS normales
            'subject' => 'required_unless:type,ranking,improvement_idea|nullable|string|max:255',
            'message' => 'required_unless:type,ranking,improvement_idea|nullable|string',

        ];
    }
}
