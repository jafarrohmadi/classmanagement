<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Classroom::class, function (Faker $faker) {
	$name = $faker->randomElement(['Biologi Class', 'Fisika Class','Kimia Class','Math Class', 'OLG Class', 'Basis Data Class']);
    $teacher_id = $faker->randomElement(['1', '2','3','4']);
    $room = $faker->randomElement(['1 C', '1 D ','2 A','4 A']);
    $from_hour = $faker->randomElement(['11 AM', '12 AM','1 PM']);
    $to_hour = $faker->randomElement(['2 PM', '3 PM','4 PM']);
    return [
        'name' => $name,
        'room' => $room,
        'from_hour' => $from_hour ,
        'to_hour' => $to_hour,
        'date' => $faker->dateTimeBetween('now', '+3 days'),
        'teacher_id' => $teacher_id
    ];
});
