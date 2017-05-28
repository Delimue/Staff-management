<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //adding 5 employees and 10 random teams
     public function run()
    {
        factory(App\Employee::class, 5)->create();
        factory(App\Team::class, 10)->create();
    }
}
