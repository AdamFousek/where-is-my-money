<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\PaymentCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

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
        $category = PaymentCategory::all()->random(1)->first();
        $user = User::has('groups')->get()->random(1)->first();

        return [
            'name' => $this->faker->words(2),
            'amount' => $this->faker->numberBetween(50, 20000),
            'user_id' => $user->pluck('id'),
            'category_id' => $category->pluck('id'),
            'group_id' => $user->groups->random(1)->pluck('id'),
        ];
    }
}
