<?php

namespace Tests\Feature\SportCenter;

use App\Models\PlayingField;
use App\Models\SportCenter;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Resources\Constants\Routes;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_show_sport_center(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $center = SportCenter::factory()->create();
        PlayingField::factory()->create([
            'sport_center_id' => $center->id
        ]);
        $this->actingAs($user);
        $response = $this->getJson(route(Routes::SPORT_CENTER_SHOW, $center->id));
        $response->assertStatus(200);
        $response->assertViewIs('sport-center.show');
    }
}
