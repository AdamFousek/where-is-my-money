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
        $user = User::has('groups')->get()->random();
        $group = $user->groups->random();
        $category = $group->categories->random();

        return [
            'name' => implode(' ', $this->faker->words(2)),
            'amount' => $this->faker->numberBetween(50, 20000),
            'user_id' => $user->id,
            'category_id' => $category->id,
            'group_id' => $group->id,
        ];
    }
}
