<?php

use App\City;
use App\Employee;
use App\EmployeeType;
use App\ManagerEntity;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'first_name'            => $faker->firstName,
        'second_name'           => $faker->firstName,
        'last_name'             => $faker->lastName,
        'mothers_last_name'     => $faker->lastName,
        'surname_husband'       => $faker->boolean ? $faker->lastName : null,
        'identity_card'         => $faker->bankAccountNumber,
        'birth_date'            => $faker->date,
        'account_number'        => $faker->creditCardNumber,
        'gender'                => $faker->boolean ? 'M' : 'F',
        'employee_type_id'      => EmployeeType::all()->random()->id,
        'city_identity_card_id' => City::all()->random()->id,
        'city_birth_id'         => City::all()->random()->id,
        'management_entity_id'  => ManagerEntity::all()->random()->id,
    ];
});
$factory->define(App\Contract::class, function (Faker $faker) {
    return [
        'employee_id' => Employee::all()->random()->id,
        'date_start'  => $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now', $timezone = null),
        'date_end'    => $faker->boolean ? $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 3 months', $timezone = null) : ($faker->boolean ? 'Libre nombramiento' : 'Comisión'),
    ];
});
