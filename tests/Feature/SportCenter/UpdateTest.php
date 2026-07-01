<?php

namespace Tests\Feature\SportCenter;

use App\Models\SportCenter;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Resources\Constants\Options;
use Src\Resources\Constants\Roles;
use Src\Resources\Constants\Routes;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_sport_center_role_failed_role_out(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $center = SportCenter::factory()->create();
        $this->actingAs($user);
        $response = $this->putJson(route(Routes::SPORT_CENTER_EDIT, $center->id));
        $response->assertStatus(403);
    }

    public function test_sport_center_role_failed_role_client(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::CLIENT);
        $response = $this->putJson(route(Routes::SPORT_CENTER_EDIT, $center->id));
        $response->assertStatus(403);
    }

    public function test_sport_center_role_failed_role_collaborator(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::COLLABORATOR);
        $response = $this->putJson(route(Routes::SPORT_CENTER_EDIT, $center->id));
        $response->assertStatus(403);
    }

    public function test_sport_center_role_owner_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $sport_center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::OWNER);
        $user->sport_centers()->syncWithoutDetaching([$sport_center->id]);
        $data = [
            'name' => 'Center One',
            'address' => 'Calle 129',
            'city' => Options::CITIES['Bogotá'],
            'lat' => 4.6097,
            'long' => -74.0817,
            'working_days' => [
                2 => ["open" => "08:00:00", "close" => "22:00:00"]
            ],
        ];
        $response = $this->putJson(route(Routes::SPORT_CENTER_EDIT, $sport_center->id), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('sport_centers', [
            'id' => $sport_center->id,
            'name' => $data['name'],
            'address' => $data['address'],
            'working_days' => json_encode($data['working_days']),
        ]);
    }

    public function test_sport_center_role_owner_falied_your_not_resource(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $sport_center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::OWNER);
        $response = $this->getJson(route(Routes::SPORT_CENTER_EDIT_FORM, $sport_center->id));
        $response->assertStatus(404);
    }

    public function test_sport_center_role_admin_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $sport_center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::ADMIN);
        $data = [
            'name' => 'Center One',
            'address' => 'Calle 129',
            'city' => Options::CITIES['Bogotá'],
            'lat' => 4.6097,
            'long' => -74.0817,
            'working_days' => [
                2 => ["open" => "08:00:00", "close" => "22:00:00"]
            ],
        ];
        $response = $this->putJson(route(Routes::SPORT_CENTER_EDIT, $sport_center->id), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('sport_centers', [
            'id' => $sport_center->id,
            'name' => $data['name'],
            'address' => $data['address'],
            'working_days' => json_encode($data['working_days']),
        ]);
    }
}
