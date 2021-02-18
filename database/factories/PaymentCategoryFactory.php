<?php

namespace Database\Factories;

use App\Models\PaymentCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $colors = [
            '#FF0000',
            '#00FF00',
            '#0000FF',
            '#FF00FF',
        ];

        return [
            'name' => implode(' ', $this->faker->words(2)),
            'color' => $colors[rand(0,3)],
        ];
    }
}
