<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

/**
 * Factory definition for model DomainFactory.
 */
$factory->define(App\Domain::class, function (Faker $faker) {
    return [
        'name' => $faker->url,
        'content_length' => rand(1, 5000),
        'status_code' => rand(100, 500),
        'body' => $faker->text(100),
        'header' => $faker->word,
        'keywords' => $faker->word,
        'description' => $faker->text(20)
    ];
});
