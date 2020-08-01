<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transactions;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transactions::class, function (Faker $faker) {
    $type = collect(['debit', 'credit'])
      ->random();
    return [
      'user_id' => User::all()->random()->id,
      'amount' => rand(1, 10000000),
      'type' => $type,
    ];
});
