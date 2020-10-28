<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(PermissoesTableSeeder::class);
        $this->call(PerfisTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(ModulosTableSeeder::class);
        $this->call(TelasTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        Model::reguard();
    }
}
