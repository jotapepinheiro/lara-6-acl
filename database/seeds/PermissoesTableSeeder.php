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
            /*  1 */ ['slug' => 'usuario-list','nome' => 'Listar Usuários','descricao' => 'Visualizar Usuários'],
            /*  2 */ ['slug' => 'usuario-create','nome' => 'Criar Usuários','descricao' => 'Criar Novos Usuários'],
            /*  3 */ ['slug' => 'usuario-edit','nome' => 'Editar Usuários','descricao' => 'Editar Usuários'],
            /*  4 */ ['slug' => 'usuario-delete','nome' => 'Deletar Usuários','descricao' => 'Deletar Usuários'],

            /*  5 */ ['slug' => 'perfil-list','nome' => 'Listar Funções','descricao' => 'Visualizar Funções'],
            /*  6 */ ['slug' => 'perfil-create','nome' => 'Criar Funções','descricao' => 'Criar Novas Funções'],
            /*  7 */ ['slug' => 'perfil-edit','nome' => 'Editar Funções','descricao' => 'Editar Funções'],
            /*  8 */ ['slug' => 'perfil-delete','nome' => 'Deletar Funções','descricao' => 'Deletar Funções'],

            /*  9 */ ['slug' => 'permissao-list','nome' => 'Listar Permissões','descricao' => 'Visualizar Permissões'],
            /* 10 */ ['slug' => 'permissao-create','nome' => 'Criar Permissões','descricao' => 'Criar Novas Permissões'],
            /* 11 */ ['slug' => 'permissao-edit','nome' => 'Editar Permissões','descricao' => 'Editar Permissões'],
            /* 12 */ ['slug' => 'permissao-delete','nome' => 'Deletar Permissões','descricao' => 'Deletar Permissões'],

            /* 13 */ ['slug' => 'modulo-list','nome' => 'Listar Módulos','descricao' => 'Visualizar Módulos'],
            /* 14 */ ['slug' => 'modulo-create','nome' => 'Criar Módulos','descricao' => 'Criar Novos Módulos'],
            /* 15 */ ['slug' => 'modulo-edit','nome' => 'Editar Módulos','descricao' => 'Editar Módulos'],
            /* 16 */ ['slug' => 'modulo-delete','nome' => 'Deletar Módulos','descricao' => 'Deletar Módulos'],

            /* 17 */ ['slug' => 'tela-list','nome' => 'Listar Telas','descricao' => 'Visualizar Telas'],
            /* 18 */ ['slug' => 'tela-create','nome' => 'Criar Telas','descricao' => 'Criar Novos Telas'],
            /* 19 */ ['slug' => 'tela-edit','nome' => 'Editar Telas','descricao' => 'Editar Telas'],
            /* 20 */ ['slug' => 'tela-delete','nome' => 'Deletar Telas','descricao' => 'Deletar Telas'],

            /* 21 */ ['slug' => 'cliente-list','nome' => 'Listar Clientes','descricao' => 'Visualizar Clientes'],
            /* 22 */ ['slug' => 'cliente-create','nome' => 'Criar Clientes','descricao' => 'Criar Novos Clientes'],
            /* 23 */ ['slug' => 'cliente-edit','nome' => 'Editar Clientes','descricao' => 'Editar Clientes'],
            /* 24 */ ['slug' => 'cliente-delete','nome' => 'Deletar Clientes','descricao' => 'Deletar Clientes'],
       ];

       foreach ($permissions as $key=>$value){
            Permissao::create($value);
       }

    }
}
