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
            'user_id' => 1,
            'name' => $this->faker->name(),
            'date_from' => Carbon::now(),
            'date_to' => Carbon::now()->addDays(5),
            'daily_budget' => 150.00,
            'total_budget' => 750.00,
            'creative_upload' => json_encode([
                'image_1.jpg',
                'imge_2.jpg',
            ])
        ];
    }
}
