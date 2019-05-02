<?php

use Faker\Generator as Faker;

$factory->define(App\UserSettings::class, function (Faker $faker) {
    $array = [
        "age" => 18,
        'dark_mode_enabled' => false,
        'language_filter_enabled' => false
    ];
    return [
        'values' => $array
    ];
});
