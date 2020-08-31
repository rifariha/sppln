<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'contains' => $faker->text,
        'image' => $faker->word,
        'photo' => $faker->word,
        'article_category_id' => $faker->randomDigitNotNull,
        'created_by' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
