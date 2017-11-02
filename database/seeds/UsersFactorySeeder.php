<?php

use Illuminate\Database\Seeder;

class UsersFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(App\Models\User::class, 1000)->create();
    }
}
