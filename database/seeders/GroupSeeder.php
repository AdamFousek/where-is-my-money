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
        Group::factory(5)->create()->each(function ($g) {
            $g->users()->attach(User::all()->random(rand(1,5))->pluck('id'));
        });
    }
}
