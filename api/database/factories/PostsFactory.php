<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Posts::class, function (Faker $faker) {
    $title = $faker->text(100);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->paragraphs(6, true),
        'image' => $faker->imageUrl(),
        'published' => true,
        'author_id' => $faker->numberBetween(1, 3),
    ];
});
