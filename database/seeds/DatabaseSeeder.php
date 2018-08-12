<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\City::class, 5)->create();
        factory(\App\Models\Category::class, 5)->create();
        factory(\App\Models\ExecutionDate::class, 5)->create();
        factory(\App\Models\ExecutionDate::class, 5)->create();
    }
}
