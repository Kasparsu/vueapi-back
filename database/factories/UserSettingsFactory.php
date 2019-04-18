<?php

use Faker\Generator as Faker;

$factory->define(App\UserSettings::class, function (Faker $faker) {
    return [
        'age' => $faker->numberBetween(18, 99),
        'biography' => $faker->sentence(),
        'language_filter_enabled' => $faker->boolean(),
        'night_mode_enabled' => $faker->boolean()
    ];
});
