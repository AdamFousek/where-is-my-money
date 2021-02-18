<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\PaymentCategory;
use Illuminate\Database\Seeder;

class PaymentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::all();
        foreach ($groups as $group) {
            $group->categories()->saveMany(
                PaymentCategory::factory(2)->make([
                    'group_id' => $group->id,
                    'user_id' => $group->users->random()->id
                ])
            );
        }
    }
}
