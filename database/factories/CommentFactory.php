<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::orderByRaw('RAND()')->take(1)->first()->id,
        'product_id' => \App\Models\Product::orderByRaw('RAND()')->take(1)->first()->id,
        'comment' => $faker->sentence(rand(50, 300)),
    ];
});
