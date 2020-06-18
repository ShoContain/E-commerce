<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'slug'=>$faker->slug,
        'featured'=>false,
        'details'=>$faker->sentence(10),
        'price'=>$faker->numberBetween(3000,100000),
        'description'=>$faker->paragraph,
        'image'=>'products/dummy/laptop-2.jpg',
        'images'=>'["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
    ];
});
