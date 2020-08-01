<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notes;
use App\Transactions;
use App\User;
use Faker\Generator as Faker;

$factory->define(Notes::class, function (Faker $faker) {
  $type = collect([User::class, Transactions::class])
    ->random();
  return [
    'title' => $faker->sentence(),
    'description' => $faker->text(),
    'noteable_id' => $type::all()->random()->id,
    'noteable_type' => $type,
  ];
});
