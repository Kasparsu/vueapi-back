<?php

use Faker\Generator as Faker;

$factory->define(App\UserSettings::class, function (Faker $faker) {
    $array = [
        "age" => 18,
        'dark_mode_enabled' => false,
        'language_filter_enabled' => false
    ];
    return [
        //'age' => $faker->numberBetween(18, 99),
        //'biography' => $faker->sentence(),
        //'language_filter_enabled' => $faker->boolean(),
        //'night_mode_enabled' => $faker->boolean()
        'values' => $array
    ];
});
