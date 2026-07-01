<?php

namespace Tests\Feature\SportCenter;

use App\Models\SportCenter;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Resources\Constants\Roles;
use Src\Resources\Constants\Routes;

class MyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_my_a_new_sport_center_role_owner_successfully(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $sport_center = SportCenter::factory()->create([
            'name' => 'Centro Lejano',
            'lat' => 10.0000,
            'long' => -70.0000,
            'working_days' => [
                1 => ["open" => "08:00:00", "close" => "22:00:00"], // Lunes
                2 => ["open" => "08:00:00", "close" => "22:00:00"], // ...
                6 => ["open" => "08:00:00", "close" => "19:00:00"], // Sábado 7PM
                7 => ["open" => "08:00:00", "close" => "16:00:00"], // Domingo 4PM
            ],
            'is_public' => false
        ]);
        ## relaciono usuario a centro deportivo
        $user->sport_centers()->syncWithoutDetaching([$sport_center->id]);
        ## Asignamos el role
        authChangeRole(role: Roles::OWNER);
        $response = $this->getJson(Routes::MY_SPORT_CENTER);
        $response->assertViewIs('sport-center.my');
        $response->assertViewHas('data', function ($viewData) use ($sport_center) {
            return $viewData->getCollection()->contains(function ($item) use ($sport_center) {
                return $item->_id === $sport_center->id;
            });
        });
    }

    public function test_it_my_a_new_sport_center_role_admin_successfully(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $sport_center = SportCenter::factory()->create([
            'name' => 'Centro Lejano',
            'lat' => 10.0000,
            'long' => -70.0000,
            'working_days' => [
                1 => ["open" => "08:00:00", "close" => "22:00:00"], // Lunes
                2 => ["open" => "08:00:00", "close" => "22:00:00"], // ...
                6 => ["open" => "08:00:00", "close" => "19:00:00"], // Sábado 7PM
                7 => ["open" => "08:00:00", "close" => "16:00:00"], // Domingo 4PM
            ],
            'is_public' => false
        ]);
        SportCenter::factory()->count(5)->create();
        ## Asignamos el role
        authChangeRole(role: Roles::ADMIN);
        $response = $this->getJson(Routes::MY_SPORT_CENTER);
        $response->assertViewIs('sport-center.my');
        $response->assertViewHas('data', function ($viewData) use ($sport_center) {
            return $viewData->getCollection()->contains(function ($item) use ($sport_center) {
                return $item->_id === $sport_center->id;
            });
        });
    }
}
