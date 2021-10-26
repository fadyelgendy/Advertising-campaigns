<?php

namespace Database\Factories;

use App\Models\Compain;
use Carbon\Carbon;
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
            'user_id' => rand(1, 10),
            'name' => $this->faker->name(),
            'date_from' => Carbon::now(),
            'date_to' => Carbon::now()->addDays(5),
            'daily_budget' => rand(150, 5000),
            'total_budget' => rand(750, 25000),
            'creative_upload' => json_encode([
                'uploads/placeholder.jpg',
                'uploads/placeholder.jpg',
            ])
        ];
    }
}
