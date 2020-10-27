<?php

use App\Model\Acl\Perfil;
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
        ))->permissoes()->sync([1,5,9,13,14,15,16]);

        Perfil::create(array(
            'nome' => 'Técnico',
            'slug' => 'tecnico',
            'descricao' => 'Usuário Técnico'
        ))->permissoes()->sync([13,14]);

        Perfil::create(array(
            'nome' => 'Usuário',
            'slug' => 'user',
            'descricao' => 'Usuário Comum'
        ))->permissoes()->sync([13]);
    }
}
