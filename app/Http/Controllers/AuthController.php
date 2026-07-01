<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Src\Modules\Auth\Infrastructure\Controllers\Create;
use Src\Resources\Constants\Messages;
use Src\Resources\Constants\Options;
use Src\Resources\Constants\Routes;

final class AuthController extends Controller
{
    public function redirectGoogle(Request $request)
    {
        authChangeRole(role: $request->query('role') ?? "");
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogle(Create $createController)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            if (!$googleUser) {
                return redirect()->route(Routes::WELCOME)
                    ->with(Messages::SESSION_ERROR, [
                        "title" => Messages::TITLE_ERROR,
                        "description" => 'No se pudo obtener la información del usuario con <span class="text-white font-bold">Google</span>. Intenta más tarde.',
                        "alertColor" => Messages::ALERT_ERROR_COLOR
                    ]);
            }
            $createController->__invoke(
                id: $googleUser->id ?? "",
                name: $googleUser->name ?? "",
                email: $googleUser->email ?? "",
                token: $googleUser->token ?? "",
                pathAvatar: $googleUser->avatar ?? "",
                role: session(Options::CURRENT_ROLE, NULL)
            );
            return redirect("/");
        } catch (\Throwable $e) {
            Log::error('Error en login con Google', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route(Routes::WELCOME)
                ->with(Messages::SESSION_ERROR, [
                    "title" => Messages::TITLE_ERROR,
                    "description" => 'Hubo un problema al iniciar sesión con <span class="text-white font-bold">Google</span>. Intenta más tarde.',
                    "alertColor" => Messages::ALERT_ERROR_COLOR
                ]);
        }
    }

    public function logout()
    {
        return authLogout();
    }

    public function changeRole(Request $request)
    {
        authChangeRole(role: $request->role ?? "");
        return redirect()->route(Routes::WELCOME);
    }
}
