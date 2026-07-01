<?php

namespace Tests\Feature\SportCenter;

use App\Models\SportCenter;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Resources\Constants\Roles;
use Src\Resources\Constants\Routes;

class FindOneTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_get_sport_center_role_failed_role_out(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $center = SportCenter::factory()->create();
        $this->actingAs($user);
        $response = $this->getJson(route(Routes::SPORT_CENTER_EDIT_FORM, $center->id));
        $response->assertStatus(403);
    }

    public function test_it_get_sport_center_role_failed_role_client(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::CLIENT);
        $response = $this->getJson(route(Routes::SPORT_CENTER_EDIT_FORM, $center->id));
        $response->assertStatus(403);
    }

    public function test_it_get_sport_center_role_failed_role_collaborator(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::COLLABORATOR);
        $response = $this->getJson(route(Routes::SPORT_CENTER_EDIT_FORM, $center->id));
        $response->assertStatus(403);
    }

    public function test_it_get_sport_center_role_owner_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $sport_center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::OWNER);
        $user->sport_centers()->syncWithoutDetaching([$sport_center->id]);
        $response = $this->getJson(route(Routes::SPORT_CENTER_EDIT_FORM, $sport_center->id));
        $response->assertViewIs('sport-center.create');
        $response->assertViewHas('item', function ($viewData) use ($sport_center) {
            return $viewData->_id === $sport_center->id;
        });
    }

    public function test_it_get_sport_center_role_owner_falied_your_not_resource(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $sport_center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::OWNER);
        $response = $this->getJson(route(Routes::SPORT_CENTER_EDIT_FORM, $sport_center->id));
        $response->assertStatus(404);
    }

    public function test_it_get_sport_center_role_admin_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $sport_center = SportCenter::factory()->create();
        $this->actingAs($user);
        authChangeRole(role: Roles::ADMIN);
        $response = $this->getJson(route(Routes::SPORT_CENTER_EDIT_FORM, $sport_center->id));
        $response->assertViewIs('sport-center.create');
        $response->assertViewHas('item', function ($viewData) use ($sport_center) {
            return $viewData->_id === $sport_center->id;
        });
    }
}
