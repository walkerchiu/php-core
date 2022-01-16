<?php

/** @var \Illuminate\Database\Eloquent\Factory  $factory */

use Faker\Generator as Faker;
use WalkerChiu\Core\Models\Entities\LogSys;

$factory->define(LogSys::class, function (Faker $faker) {
    return [
        'summary'        => ['name' => $faker->name],
        'data'           => ['name' => $faker->name],
        'is_highlighted' => $faker->boolean
    ];
});
