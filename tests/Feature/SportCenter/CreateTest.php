<?php

namespace Tests\Feature\SportCenter;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Resources\Constants\Options;
use Src\Resources\Constants\Routes;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_creates_a_new_sport_center_record_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = [
            'name' => 'Center One',
            'address' => 'Calle 129',
            'city' => Options::CITIES['Bogotá'],
            'lat' => 4.6097,
            'long' => -74.0817,
            'working_days' => [
                1 => ["open" => "08:00:00", "close" => "22:00:00"], // Lunes
                2 => ["open" => "08:00:00", "close" => "22:00:00"], // ...
                6 => ["open" => "08:00:00", "close" => "19:00:00"], // Sábado 7PM
                7 => ["open" => "08:00:00", "close" => "16:00:00"], // Domingo 4PM
            ],
            'is_public' => false
        ];
        $response = $this->postJson(Routes::SPORT_CENTER, $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('sport_centers', [
            'id' => 1,
            'name' => $data['name'],
            'address' => $data['address'],
            'working_days' => json_encode($data['working_days']),
            'is_public' => 0
        ]);
        $this->assertDatabaseHas('sport_center_user', [
            'id' => 1,
            'user_id' => 1,
            'sport_center_id' => 1,
        ]);
    }

    public function test_it_returns_validation_errors_for_invalid_data(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = [
            'name' => 'Center One',
            'address' => 'Calle 129',
            'city' => Options::CITIES['Bogotá'],
        ];
        $response = $this->postJson(Routes::SPORT_CENTER, $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'lat',
            'long',
        ]);
        $this->assertDatabaseCount('sport_center_user', 0);
    }
}
