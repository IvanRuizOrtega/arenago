<?php

namespace Database\Factories;

use App\Models\PlayingField;
use App\Models\SportCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Resources\Constants\Options;

/**
 * @extends Factory<PlayingField>
 */
class PlayingFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sportKeys = array_keys(Options::SPORT_CENTERS);
        return [
            // Crea un SportCenter automáticamente si no se le pasa un ID explícito
            'sport_center_id' => SportCenter::factory(),

            // Genera nombres realistas como "Cancha Central", "Estadio Premium", etc.
            'name' => $this->faker->optional(0.8)->randomElement([
                'Cancha Central', 'Campo Sintético', 'Pista Norte', 'Cancha Alborada', 'Arena Principal'
            ]),

            // Selecciona dinámicamente una llave aleatoria de tu constante de opciones
            'type' => $this->faker->randomElement($sportKeys),

            // Precios por hora realistas (ej. entre 50,000 y 180,000 COP) con 2 decimales
            'price_hour' => $this->faker->randomFloat(2, 50000, 180000),

            // Define de forma aleatoria si es techada o no (true/false)
            'covered' => $this->faker->boolean(50),
        ];
    }
}
