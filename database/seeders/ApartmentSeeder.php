<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1, 3) as $index) {
            DB::table('apartment')->insert ([
                'description' => "Apartment ". strval($index),
                'status' => "Unoccupied",
                'rental_fee' => 1000,
            ]);
        }
    }
}
