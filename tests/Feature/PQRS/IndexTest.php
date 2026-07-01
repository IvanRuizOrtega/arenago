<?php

namespace Tests\Feature\PQRS;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\PQRS;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Resources\Constants\Routes;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /* public function test_it_index_without_user_a_new_sport_center_record_successfully(): void */
    /* { */
    /*     /1* $this->withoutExceptionHandling(); *1/ */
    /*     $position = new \Stevebauman\Location\Position(); */
    /*     $position->latitude = 4.6097; */
    /*     $position->longitude = -74.0817; */

    /*     \Stevebauman\Location\Facades\Location::shouldReceive('get') */
    /*         ->once() */
    /*         ->andReturn($position); */
    /*     $nearbyCenter = SportCenter::factory()->create([ */
    /*         'name' => 'Centro Cercano', */
    /*         'lat' => 4.6100, */
    /*         'long' => -74.0820 */
    /*     ]); */
    /*     $farCenter = SportCenter::factory()->create([ */
    /*         'name' => 'Centro Lejano', */
    /*         'lat' => 10.0000, */
    /*         'long' => -70.0000 */
    /*     ]); */
    /*     SportCenter::factory()->count(10000)->create(); */
    /*     $response = $this->getJson(Routes::SPORT_CENTER); */
    /*     $response->assertStatus(200); */
    /*     $response->assertViewIs('sport-center.index'); */
    /*     $response->assertViewHas('data', function ($viewData) use ($nearbyCenter) { */
    /*         return $viewData->getCollection()->contains($nearbyCenter); */
    /*     }); */
    /*     $response->assertViewHas('data', function ($viewData) use ($farCenter) { */
    /*         return !$viewData->getCollection()->contains($farCenter); */
    /*     }); */
    /* } */

    /* public function test_it_returns_validation_errors_for_invalid_data(): void */
    /* { */
    /*     $user = User::factory()->create(); */
    /*     $this->actingAs($user); */
    /*     $data = [ */
    /*         'name' => 'Center One', */
    /*         'address' => 'Calle 129', */
    /*         'city' => 'Bogota', */
    /*     ]; */
    /*     $response = $this->postJson(Routes::SPORT_CENTER, $data); */
    /*     $response->assertStatus(422); */
    /*     $response->assertJsonValidationErrors([ */
    /*         'lat', */
    /*         'long', */
    /*     ]); */
    /*     $this->assertDatabaseCount('sport_center_user', 0); */
    /* } */
}
