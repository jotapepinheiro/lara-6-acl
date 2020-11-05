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

        /* 01 */
        Perfil::create([
            'nome' => 'Super Administrador',
            'slug' => 'super',
            'descricao' => 'Super Administrador do Sistema'
        ]);

        /* 02 */
        Perfil::create([
            'nome' => 'Administrador',
            'slug' => 'admin',
            'descricao' => 'Administrador do Sistema'
        ])->permissoes()->sync([1,2,3,5,6,7,9,10,11,13,14,15,17,18,19,21,22,23]);

        /* 03 */
        Perfil::create([
            'nome' => 'Administrador SGA',
            'slug' => 'admin-sga',
            'descricao' => 'Administrador SGA do Sistema'
        ])->permissoes()->sync([1,2,3,5,6,7,9,10,11,13,14,15,17,18,19,21,22,23]);

        /* 04 */
         Perfil::create([
             'nome' => 'Administrador Fornecedor',
             'slug' => 'admin-fornecedor',
             'descricao' => 'Administrador Fornecedor do Sistema'
         ])->permissoes()->sync([1,2,3,5,6,7,9,10,11,13,14,15,17,18,19,21,22,23]);

        /* 05 */
        Perfil::create([
            'nome' => 'Principal',
            'slug' => 'principal',
            'descricao' => 'Usuário Principal'
        ])->permissoes()->sync([13,14]);

        /* 06 */
        Perfil::create([
            'nome' => 'SGA',
            'slug' => 'sga',
            'descricao' => 'Usuário SGA'
        ])->permissoes()->sync([13,14]);

        /* 07 */
        Perfil::create([
            'nome' => 'Fornecedor',
            'slug' => 'fornecedor',
            'descricao' => 'Usuário Fornecedor'
        ])->permissoes()->sync([13,14]);

        /* 08 */
        Perfil::create([
            'nome' => 'Convidado',
            'slug' => 'convidado',
            'descricao' => 'Usuário Convidado'
        ])->permissoes()->sync([13]);

    }
}
