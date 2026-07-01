<?php

namespace App\Http\Requests\Booking;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Src\Modules\Booking\Infrastructure\Controllers\FindByUser as ControllersFindByUser;
use Src\Resources\Constants\Options;

class Team extends FormRequest
{
    private ControllersFindByUser $ctr;

    public function __construct(ControllersFindByUser $ctr)
    {
        $this->ctr = $ctr;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        try {
            $id = (int) $this->route("id");
            $user_id = getPropertyAuth(property: 'id');
            $response = $this->ctr->__invoke(id: $id, user_id: $user_id);
            if (!$response->find ?? FALSE) return false;
            if ($response->status != array_keys(Options::STATUS)[0]) return false;
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    protected function prepareForValidation()
    {
        // Decodificamos los inputs JSON a arrays de PHP para que Laravel pueda validarlos fácilmente
        $this->merge([
            'team_a_array' => json_decode($this->input('team_a'), true) ?? [],
            'team_b_array' => json_decode($this->input('team_b'), true) ?? [],
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'team_a' => ['required', 'json'],
            'team_b' => ['required', 'json'],

            // Validamos los arrays decodificados internamente
            'team_a_array' => ['required', 'array', 'min:2'],
            'team_b_array' => ['required', 'array', 'min:2'],
            'team_a_array.*' => ['integer', 'exists:users,id'],
            'team_b_array.*' => ['integer', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'team_a_array.min' => 'El Equipo A (Local) debe tener al menos 2 jugadores.',
            'team_b_array.min' => 'El Equipo B (Visitante) debe tener al menos 2 jugadores.',
            'team_a_array.*.exists' => 'Uno de los jugadores asignados al Equipo A no es válido.',
            'team_b_array.*.exists' => 'Uno de los jugadores asignados al Equipo B no es válido.',
        ];
    }
}
