<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Teacher::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    return [
        'teacher_nip' => 'NIP'.date('Y').$faker->unique()->randomNumber(4),
        'name' => $faker->name($gender),
        'gender' => $gender,
        'dob' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = '-9 years'),
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'experience' => $faker->realText($maxNbChars = 200, $indexSize = 2)
    ];

});
