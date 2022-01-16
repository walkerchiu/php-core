<?php

/** @var \Illuminate\Database\Eloquent\Factory  $factory */

use Faker\Generator as Faker;
use WalkerChiu\Core\Models\Entities\LogRequestFactory;

$factory->define(LogRequestFactory::class, function (Faker $faker) {
    return [
        'type'     => $faker->randomElement(['sync', 'notify', 'auth']),
        'action'   => $faker->randomElement(['in', 'out']),
        'api'      => $faker->randomElement(['account', 'device', 'group']),
        'status'   => $faker->randomElement([200, 201, 207, 301, 302, 400, 401, 403, 404, 422, 429, 500, 503]),
        'request'  => ['name' => $faker->name],
        'response' => ['name' => $faker->name],
        'header'   => ['name' => $faker->name]
    ];
});
