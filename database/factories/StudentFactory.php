<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Students::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    return [
        'student_nis' => 'NIS'.date('Y').$faker->unique()->randomNumber(4),
        'name' => $faker->name($gender),
        'gender' => $gender,
        'dob' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = '-9 years'),
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
    ];

});
