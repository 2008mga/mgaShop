<?php

use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Characteristic::query()
            ->delete();

        factory(App\Models\Characteristic::class, 50)->create();
    }
}
