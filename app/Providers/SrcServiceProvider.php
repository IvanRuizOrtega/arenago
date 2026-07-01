<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class SrcServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $modules = $this->getPathModules();
        foreach ($modules as $module) {
            $module = require base_path($module);
            $this->registerRepositories($module->repositories);
            $this->registerRoutes($module->routes);
        }
    }

    public function boot(): void
    {
        //
    }

    private function registerRoutes(array $routes)
    {
        foreach ($routes as $route) {
            Route::prefix("")->group(base_path($route));
        }
    }

    private function registerRepositories(array $repositories)
    {
        foreach ($repositories as $repository) {
            $this->app->bind(
                $repository->contract,
                $repository->repository,
                $repository->case
            );
        }
    }

    private function getPathModules(): array
    {
        return [
            "src/Modules/Auth/Domain/Config/config.php",
            "src/Modules/SportCenter/Domain/Config/config.php",
            "src/Modules/PlayingField/Domain/Config/config.php",
            "src/Modules/Booking/Domain/Config/config.php",
            "src/Modules/MatchPlayerStat/Domain/Config/config.php",
            "src/Modules/MyStaff/Domain/Config/config.php",
            "src/Modules/PQRS/Domain/Config/config.php",
            "src/Modules/User/Domain/Config/config.php",
        ];
    }
}
