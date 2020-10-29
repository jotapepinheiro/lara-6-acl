<?php

use App\Model\Acl\Permissao;
use Illuminate\Database\Seeder;

class PermissoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            /*  1 */ ['tela_id' => 5, 'slug' => 'usuario-list','nome' => 'Listar Usuários','descricao' => 'Visualizar Usuários'],
            /*  2 */ ['tela_id' => 5, 'slug' => 'usuario-create','nome' => 'Criar Usuários','descricao' => 'Criar Novos Usuários'],
            /*  3 */ ['tela_id' => 5, 'slug' => 'usuario-edit','nome' => 'Editar Usuários','descricao' => 'Editar Usuários'],
            /*  4 */ ['tela_id' => 5, 'slug' => 'usuario-delete','nome' => 'Deletar Usuários','descricao' => 'Deletar Usuários'],

            /*  5 */ ['tela_id' => 6, 'slug' => 'perfil-list','nome' => 'Listar Perfis','descricao' => 'Visualizar Perfis'],
            /*  6 */ ['tela_id' => 6, 'slug' => 'perfil-create','nome' => 'Criar Perfis','descricao' => 'Criar Novas Perfis'],
            /*  7 */ ['tela_id' => 6, 'slug' => 'perfil-edit','nome' => 'Editar Perfis','descricao' => 'Editar Perfis'],
            /*  8 */ ['tela_id' => 6, 'slug' => 'perfil-delete','nome' => 'Deletar Perfis','descricao' => 'Deletar Perfis'],

            /*  9 */ ['tela_id' => 7, 'slug' => 'permissao-list','nome' => 'Listar Permissões','descricao' => 'Visualizar Permissões'],
            /* 10 */ ['tela_id' => 7, 'slug' => 'permissao-create','nome' => 'Criar Permissões','descricao' => 'Criar Novas Permissões'],
            /* 11 */ ['tela_id' => 7, 'slug' => 'permissao-edit','nome' => 'Editar Permissões','descricao' => 'Editar Permissões'],
            /* 12 */ ['tela_id' => 7, 'slug' => 'permissao-delete','nome' => 'Deletar Permissões','descricao' => 'Deletar Permissões'],

            /* 13 */ ['tela_id' => 8, 'slug' => 'modulo-list','nome' => 'Listar Módulos','descricao' => 'Visualizar Módulos'],
            /* 14 */ ['tela_id' => 8, 'slug' => 'modulo-create','nome' => 'Criar Módulos','descricao' => 'Criar Novos Módulos'],
            /* 15 */ ['tela_id' => 8, 'slug' => 'modulo-edit','nome' => 'Editar Módulos','descricao' => 'Editar Módulos'],
            /* 16 */ ['tela_id' => 8, 'slug' => 'modulo-delete','nome' => 'Deletar Módulos','descricao' => 'Deletar Módulos'],

            /* 17 */ ['tela_id' => 9, 'slug' => 'tela-list','nome' => 'Listar Telas','descricao' => 'Visualizar Telas'],
            /* 18 */ ['tela_id' => 9, 'slug' => 'tela-create','nome' => 'Criar Telas','descricao' => 'Criar Novos Telas'],
            /* 19 */ ['tela_id' => 9, 'slug' => 'tela-edit','nome' => 'Editar Telas','descricao' => 'Editar Telas'],
            /* 20 */ ['tela_id' => 9, 'slug' => 'tela-delete','nome' => 'Deletar Telas','descricao' => 'Deletar Telas'],

            /* 21 */ ['tela_id' => 14, 'slug' => 'cliente-list','nome' => 'Listar Clientes','descricao' => 'Visualizar Clientes'],
            /* 22 */ ['tela_id' => 14, 'slug' => 'cliente-create','nome' => 'Criar Clientes','descricao' => 'Criar Novos Clientes'],
            /* 23 */ ['tela_id' => 14, 'slug' => 'cliente-edit','nome' => 'Editar Clientes','descricao' => 'Editar Clientes'],
            /* 24 */ ['tela_id' => 14, 'slug' => 'cliente-delete','nome' => 'Deletar Clientes','descricao' => 'Deletar Clientes'],
       ];

       foreach ($permissions as $key=>$value){
            Permissao::create($value);
       }

    }
}
