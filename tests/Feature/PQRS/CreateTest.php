<?php

namespace Tests\Feature\PQRS;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Resources\Constants\Routes;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_created_pqrs_form(): void
    {
        /* $this->withoutExceptionHandling(); */
        $response = $this->getJson(Routes::PQRS);
        $response->assertStatus(200);
        $response->assertSee('Centro de Atención');
        $response->assertSee('Tipo de Solicitud');
        $response->assertSee('¿Cómo calificarías la plataforma?');
        $response->assertSee('Respuesta Rápida');
    }

    public function test_it_create_a_new_pqrs_record_with_out_user_type_ranking_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $data = [
            'type' => 'ranking',
            'ranking' => 1
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('pqrs', [
            'id' => 1,
            'type' => $data['type'],
            'ranking' => $data['ranking'],
            'improvement_idea' => NULL,
            'subject' => NULL,
            'message' => NULL,
            'user_id' => NULL
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_out_user_type_ranking_failed(): void
    {
        $data = [
            'type' => 'ranking',
            'ranking' => 0
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'ranking',
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_user_type_ranking_successfully(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = [
            'type' => 'ranking',
            'ranking' => 5
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('pqrs', [
            'id' => 1,
            'type' => $data['type'],
            'ranking' => $data['ranking'],
            'improvement_idea' => NULL,
            'subject' => NULL,
            'message' => NULL,
            'user_id' => $user->id
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_out_user_type_improvement_idea_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $data = [
            'type' => 'improvement_idea',
            'improvement_idea' => "Estadisticas para los jugadores"
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('pqrs', [
            'id' => 1,
            'type' => $data['type'],
            'ranking' => NULL,
            'improvement_idea' => $data['improvement_idea'],
            'subject' => NULL,
            'message' => NULL,
            'user_id' => NULL
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_out_user_type_improvement_idea_failed(): void
    {
        $data = [
            'type' => 'improvement_idea',
            'improvement_idea' => NULL
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'improvement_idea',
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_user_type_improvement_idea_successfully(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = [
            'type' => 'improvement_idea',
            'improvement_idea' => "Todo ok"
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('pqrs', [
            'id' => 1,
            'type' => $data['type'],
            'ranking' => NULL,
            'improvement_idea' => $data['improvement_idea'],
            'subject' => NULL,
            'message' => NULL,
            'user_id' => $user->id
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_out_user_type_suggestion_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $data = [
            'type' => 'suggestion',
            'subject' => "Asunto",
            'message' => "message"
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('pqrs', [
            'id' => 1,
            'type' => $data['type'],
            'ranking' => NULL,
            'improvement_idea' => NULL,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'user_id' => NULL
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_out_user_type_suggestion_failed(): void
    {
        $data = [
            'type' => 'suggestion',
            'subject' => NULL,
            'message' => NULL
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'subject', 'message'
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_user_type_suggestion_successfully(): void
    {
        /* $this->withoutExceptionHandling(); */
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = [
            'type' => 'suggestion',
            'subject' => "Asunto",
            'message' => "message"
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('pqrs', [
            'id' => 1,
            'type' => $data['type'],
            'ranking' => NULL,
            'improvement_idea' => NULL,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'user_id' => $user->id
        ]);
    }

    public function test_it_create_a_new_pqrs_record_with_out_user_type_not_exists_failed(): void
    {
        /* $this->withExceptionHandling(); */
        $data = [
            'type' => 'no_exists',
        ];
        $response = $this->postJson(Routes::PQRS, $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'subject', 'message', 'type'
        ]);
    }
}
