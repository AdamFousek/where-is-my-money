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
        $category = PaymentCategory::all()->random(1);
        $user = User::has('group')->random(1);

        return [
            'name' => $this->faker->words(2),
            'color' => $colors[rand(0,count($colors))],
            'user_id' => $user->pluck('id'),
            'category_id' => $category->pluck('id'),
            'group_id' => $user->groups()->random(1)->pluck('id'),
        ];
    }
}
