<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Model\Cliente;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i ++)
        {
            Cliente::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail
            ]);
        }

    }
}
