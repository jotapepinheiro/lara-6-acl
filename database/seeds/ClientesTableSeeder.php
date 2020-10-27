<?php
use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i<=100; $i++):
            DB::table('clientes')
                ->insert([
                'name'      => $faker->name,
                'email'      => $faker->email,
                ]);
        endfor;
    }
}
