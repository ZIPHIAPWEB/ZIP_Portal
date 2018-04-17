<?php

use Faker\Generator as Faker;

$factory->define(\App\Student::class, function (Faker $faker) {
    return [
        'user_id'                   => $faker->randomNumber(),
        'first_name'                => $faker->firstName,
        'middle_name'               => $faker->lastName,
        'last_name'                 => $faker->lastName,
        'birthdate'                 => $faker->date('Y-m-d'),
        'gender'                    => $faker->randomElement(array('MALE', 'FEMALE')),
        'address'                   => $faker->address,
        'home_number'               => $faker->phoneNumber,
        'mobile_number'             => $faker->phoneNumber,
        'school'                    => $faker->city,
        'year'                      => $faker->randomElement(array('First Year', 'Second Year', 'Third Year', 'Fourth Year')),
        'skype_id'                  => $faker->randomNumber(),
        'program_id_no'             => $faker->randomNumber(),
        'sevis_id'                  => $faker->randomNumber(),
        'host_company_id'           => $faker->randomNumber(),
        'position'                  => $faker->randomElement(array('Chef', 'Kitchen Staff')),
        'location'                  => $faker->city,
        'stipend'                   => $faker->randomNumber(),
        'fb_email'                  => $faker->email,
        'visa_interview_status'     => 'No Schedule',
        'program_start_date'        => $faker->date('Y-m-d'),
        'program_end_date'          => $faker->date('Y-m-d'),
        'visa_sponsor_id'           => $faker->randomNumber(),
        'date_of_departure'         => $faker->date('Y-m-d'),
        'date_of_arrival'           => $faker->date('Y-m-d'),
        'application_id'            => $faker->randomNumber(),
        'program_id'                => $faker->randomNumber(),
        'application_status'        => 'New Applicant',
    ];
});
