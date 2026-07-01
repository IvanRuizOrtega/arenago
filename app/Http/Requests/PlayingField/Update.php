<?php

namespace App\Http\Requests\PlayingField;

use Illuminate\Contracts\Validation\ValidationRule;
use Src\Modules\PlayingField\Infrastructure\Controllers\Show as ControllersPlayingFieldShow;
use Src\Resources\Constants\Roles;

class Update extends Create
{
    private ControllersPlayingFieldShow $ctr;

    public function __construct(ControllersPlayingFieldShow $ctr)
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
            $playing_field_id = (int) $this->route("playing_field_id");
            $user_id = in_array(authCurrentRole(), [Roles::OWNER, Roles::COLLABORATOR]) ? getPropertyAuth(property: 'id') : NULL;
            $this->ctr->__invoke(id: $playing_field_id, sport_center_id: $id, user_id: $user_id);
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
        return parent::rules();
    }
}
