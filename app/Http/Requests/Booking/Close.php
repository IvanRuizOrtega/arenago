<?php

namespace App\Http\Requests\Booking;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Src\Modules\Booking\Infrastructure\Controllers\FindByUser as ControllersFindByUser;
use Src\Resources\Constants\Options;

class Close extends FormRequest
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
            if ($response->status != array_keys(Options::STATUS)[2]) return false;
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'goals_team_a' => ['required', 'integer', 'min:0'],
            'goals_team_b' => ['required', 'integer', 'min:0'],
            'service_rating' => ['required', 'integer', 'between:1,5'],
        ];
    }

    public function messages(): array
    {
        return [
            'goals_team_a.min' => 'Los goles no pueden ser negativos.',
            'goals_team_b.min' => 'Los goles no pueden ser negativos.',
            'service_rating.required' => 'Por favor, selecciona una calificación para la atención.',
            'service_rating.between'  => 'La calificación de la atención debe estar entre 1 y 5 estrellas.',
        ];
    }
}
