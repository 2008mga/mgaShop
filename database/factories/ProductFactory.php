<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'image' => $faker->imageUrl('1024', '1024'),
        'images' => [
            $faker->imageUrl('1024', '1024'),
            $faker->imageUrl('1024', '1024'),
            $faker->imageUrl('1024', '1024'),
            $faker->imageUrl('1024', '1024'),
        ],
        'category_id' => \App\Models\Category::orderByRaw('RAND()')->take(1)->first()->id,
        'price' => $faker->numberBetween(100, 10000)
    ];
});
