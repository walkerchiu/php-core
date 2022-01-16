<?php

/** @var \Illuminate\Database\Eloquent\Factory  $factory */

use Faker\Generator as Faker;
use WalkerChiu\Core\Models\Entities\Log;

$factory->define(Log::class, function (Faker $faker) {
    return [
        'summary'        => ['name' => $faker->name],
        'data'           => ['name' => $faker->name],
        'header'         => ['name' => $faker->name],
        'is_highlighted' => $faker->boolean
    ];
});
