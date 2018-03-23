<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()
            ->delete();
        factory(Product::class, 100)->create()->each(function (Product $product) {
            for ($i = 0; $i < rand(10,50); $i++) {
                $characteristic = \App\Models\Characteristic::orderByRaw('RAND()')->take(1)->first();
                $product->characteristicable()->save($characteristic, ['value' => 'test', 'characteristic_id' => $characteristic->id]);
            }
        });
    }
}
