<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DppDocument;
use Faker\Generator as Faker;

$factory->define(DppDocument::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'file' => $faker->word,
        'inputted_by' => $faker->word,
        'category' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
