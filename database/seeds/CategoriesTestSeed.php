<?php

use Illuminate\Database\Seeder;

class CategoriesTestSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::query()
            ->delete();
        factory(\App\Models\Category::class, 10)->create();
    }
}
