<?php

namespace App\Http\Requests\SportCenter;

use Illuminate\Contracts\Validation\ValidationRule;
use Src\Modules\SportCenter\Infrastructure\Controllers\FindOne as ControllersFindOne;
use Src\Resources\Constants\Roles;

class Update extends Create
{
    private ControllersFindOne $ctr;

    public function __construct(ControllersFindOne $ctr)
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
            $user_id = in_array(authCurrentRole(), [Roles::OWNER]) ? getPropertyAuth(property: 'id') : NULL;
            $this->ctr->__invoke(user_id: $user_id, id: $id);
            return TRUE;
        } catch (\Exception) {
            return FALSE;
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
