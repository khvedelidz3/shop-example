<?php

use Illuminate\Database\Seeder;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
       for ($i = 0; $i < 20; $i++) {
             App\Product::create([
                'name' => $faker->name,
                'price' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 90),
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true), 
             ]);
       }
    }
}
