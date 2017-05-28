<?php

//Factories to fill our database up with random data

//Employee data

$factory->define(App\Employee::class, function (Faker\Generator $faker){
    
    //random phonenumber with 9 digits
    $phone      = $faker->numberBetween(100000000, 999999999);
    
    //generate a random title from this array
    $titles     = [
        'PHP Developer',
        'HR Management',
        'JavaScript Developer',
        'HTML/CSS Developer'
    ];
    
    //random salary
    $salary     = $faker->numberBetween(50000, 200000);
    
    //populate our database in these tables
    return [
        'firstName' => $faker->firstName,
        'lastName'  => $faker->lastName,
        'userName'  => $faker->userName,
        'phone'     => $phone,
        'email'     => $faker->email,
        'title'     => $faker->randomElement($array = $titles),
        'salary'    => $salary
    ];
    
});

//Team data

$factory->define(App\Team::class, function (Faker\Generator $faker){
    
    //generate a random team from this array
    $teams     = [
        'Junior team',
        '4mation PHP team',
        'Project team',
        'Soccer team'
    ];
   
    return [
        'teamName'      => $faker->randomElement($array = $teams),
        'employee_id'   => $faker->numberBetween(1, 5)  //add to an employee.
    ];
});
