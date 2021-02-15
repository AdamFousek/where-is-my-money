<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::factory(10)->create()->each(function ($g) {
            $g->users()->attach(User::all()->random(rand(0,10))->pluck('id'));
        });
    }
}
