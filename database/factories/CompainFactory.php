<?php

namespace Database\Factories;

use App\Models\Compain;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->name(),
            'date_from' => $this->faker->date('Y-m-d', now()),
            'date_to' => $this->faker->date('Y-m-d', 7),
            'daily_budget' => $this->faker->randomDigitNotNull(),
            'total_budget' => $this->faker->randomDigitNotNull(),
            'creative_upload' => json_encode([
                'image_1.jpg',
                'imge_2.jpg',
            ])
        ];
    }
}
