<?php

/** @var \Illuminate\Database\Eloquent\Factory  $factory */

use Faker\Generator as Faker;
use WalkerChiu\Core\Models\Entities\LogSearch;

$factory->define(LogSearch::class, function (Faker $faker) {
    return [
        'keyword' => $faker->name,
        'data'    => ['name' => $faker->name]
    ];
});
