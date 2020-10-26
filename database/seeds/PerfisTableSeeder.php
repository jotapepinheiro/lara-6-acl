<?php

use App\Perfil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfis')->delete();

        Perfil::create(array(
            'nome' => 'Super Administrador',
            'slug' => 'super',
            'descricao' => 'Super Administrador do Sistema'
        ));

        Perfil::create(array(
            'nome' => 'Administrador',
            'slug' => 'admin',
            'descricao' => 'Administrador do Sistema'
        ))->perms()->sync([1,5,9,13,14,15,16]);

        Perfil::create(array(
            'nome' => 'Técnico',
            'slug' => 'tecnico',
            'descricao' => 'Usuário Técnico'
        ))->perms()->sync([13,14]);
    }
}
