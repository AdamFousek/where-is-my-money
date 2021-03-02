<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(100);
        $slug = Str::uuid();
        $user = User::all()->random(1)->first();
        return [
            'name' => $title,
            'uuid' => $slug,
            'user_id' => $user->id,
        ];
    }
}
