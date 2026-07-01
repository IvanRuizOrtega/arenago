<?php

namespace App\Http\Requests\SportCenter;

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
            'name'    => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city'    => ['required', 'string', 'max:100', Rule::in(Options::CITIES)],
            // Validamos latitud y longitud con rangos geográficos reales
            'lat'     => ['required', 'numeric', 'between:-90,90'],
            'long'    => ['required', 'numeric', 'between:-180,180'],
            'working_days' => ['nullable', 'array'],
            // Valida que las llaves sean del 1 al 7 (Lunes a Domingo)
            // Nota: Laravel permite validar las llaves usando '*'
            'working_days.*' => ['array:open,close'], // Asegura que solo contenga 'open' y 'close'
            'working_days.*.open'  => ['required_with:working_days.*', 'date_format:H:i:s'],
            'working_days.*.close' => ['required_with:working_days.*', 'date_format:H:i:s'],
            /* 'is_public'    => ['required', 'boolean'], */
        ];
    }
}
