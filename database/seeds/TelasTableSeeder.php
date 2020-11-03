<?php

use App\Model\Acl\Tela;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('telas')->delete();

        // Principal
        Tela::create([
            'modulo_id' => 1,
            'nome' => 'Cadastro de Filiais',
            'slug' => 'tela-cadastro-filiais',
            'descricao' => 'Tela de Cadastros de Filiais'
        ]);

        Tela::create([
            'modulo_id' => 1,
            'nome' => 'Cadastro de Agentes',
            'slug' => 'tela-cadastro-agentes',
            'descricao' => 'Tela de Cadastro de Agentes'
        ]);

        // Workflow
        Tela::create([
            'modulo_id' => 2,
            'nome' => 'Cadastro de Workflow',
            'slug' => 'tela-cadastro-workflow',
            'descricao' => 'Tela de Cadastros de Workflow'
        ]);

        Tela::create([
            'modulo_id' => 2,
            'nome' => 'Cadastro de Alertas',
            'slug' => 'tela-cadastro-alertas',
            'descricao' => 'Tela de Cadastros de Alertas'
        ]);

        // Administração
        Tela::create([
            'modulo_id' => 3,
            'nome' => 'Cadastro de Usuários',
            'slug' => 'tela-cadastro-usuarios',
            'descricao' => 'Tela de Cadastro de Usuários'
        ]);

        Tela::create([
            'modulo_id' => 3,
            'nome' => 'Cadastro de Perfis',
            'slug' => 'tela-cadastro-perfis',
            'descricao' => 'Tela de Cadastro de Perfis'
        ]);

        Tela::create([
            'modulo_id' => 3,
            'nome' => 'Cadastro de Permissões',
            'slug' => 'tela-cadastro-permissoes',
            'descricao' => 'Tela de Cadastro de Permissões'
        ]);

        Tela::create([
            'modulo_id' => 3,
            'nome' => 'Cadastro de Módulos',
            'slug' => 'tela-cadastro-modulos',
            'descricao' => 'Tela de Cadastro de Módulos'
        ]);

        Tela::create([
            'modulo_id' => 3,
            'nome' => 'Cadastro de Telas',
            'slug' => 'tela-cadastro-telas',
            'descricao' => 'Tela de Cadastro de Telas'
        ]);

        Tela::create([
            'modulo_id' => 3,
            'nome' => 'Conte Conosco',
            'slug' => 'tela-conte-conosco',
            'descricao' => 'Tela de Conte Conosco'
        ]);

        // Parâmetros
        Tela::create([
            'modulo_id' => 4,
            'nome' => 'Principal',
            'slug' => 'tela-principal',
            'descricao' => 'Tela Principal'
        ]);

        Tela::create([
            'modulo_id' => 4,
            'nome' => 'Complience',
            'slug' => 'tela-complience',
            'descricao' => 'Tela de Complience'
        ]);

        Tela::create([
            'modulo_id' => 4,
            'nome' => 'Fornecedores',
            'slug' => 'tela-fornecedores',
            'descricao' => 'Tela de Fornecedores'
        ]);

        Tela::create([
            'modulo_id' => 4,
            'nome' => 'Clientes',
            'slug' => 'tela-clientes',
            'descricao' => 'Tela de Clientes'
        ]);


        // Complience
        Tela::create([
            'modulo_id' => 5,
            'nome' => 'Cruzamentos',
            'slug' => 'tela-cruzamentos',
            'descricao' => 'Tela de Cruzamentos'
        ]);

        Tela::create([
            'modulo_id' => 5,
            'nome' => 'Cockpit',
            'slug' => 'tela-cockpit',
            'descricao' => 'Tela de Cockpit'
        ]);

        // Operações
        Tela::create([
            'modulo_id' => 6,
            'nome' => 'Gestão de DFE',
            'slug' => 'tela-gestao-dfe',
            'descricao' => 'Tela de Gestão DFE'
        ]);

        Tela::create([
            'modulo_id' => 6,
            'nome' => 'Gestão de Pré-Nota',
            'slug' => 'tela-gestao-pre-nota',
            'descricao' => 'Tela de Gestão de Pré-Nota'
        ]);

        Tela::create([
            'modulo_id' => 6,
            'nome' => 'Gestão de NFS',
            'slug' => 'tela-gestao-nfs',
            'descricao' => 'Tela de Gestão de NFS'
        ]);

        // Calendário
        Tela::create([
            'modulo_id' => 7,
            'nome' => 'Obrigações/Atividades',
            'slug' => 'tela-obrigacoes-atividades',
            'descricao' => 'Tela de Obrigações/Atividades de Calendário'
        ]);

        Tela::create([
            'modulo_id' => 7,
            'nome' => 'Gestão de Atividades',
            'slug' => 'tela-atividades',
            'descricao' => 'Tela de Gestão de Atividades de Calendário'
        ]);

        // Conteúdo
        Tela::create([
            'modulo_id' => 8,
            'nome' => 'Dasboard',
            'slug' => 'tela-dasboard',
            'descricao' => 'Tela de Conteúdo de Dasboard'
        ]);

        Tela::create([
            'modulo_id' => 8,
            'nome' => 'Cadastro de Atos',
            'slug' => 'tela-atos',
            'descricao' => 'Tela de Conteúdo de Atos'
        ]);

        Tela::create([
            'modulo_id' => 8,
            'nome' => 'Cadastro de Conteúdo',
            'slug' => 'tela-conteudo-cadastro',
            'descricao' => 'Tela de Conteúdo de Cadastro'
        ]);

        // Qualidade de Dados
        Tela::create([
            'modulo_id' => 9,
            'nome' => 'Saneamento de Arquivos',
            'slug' => 'tela-saneamento-de-arquivos',
            'descricao' => 'Tela de Qualidade de Dados de Saneamento de Arquivos'
        ]);

        Tela::create([
            'modulo_id' => 9,
            'nome' => 'Cadastro de Materias',
            'slug' => 'tela-cadastro-de-materias',
            'descricao' => 'Tela de Qualidade de Dados de Cadastro de Materias'
        ]);

        Tela::create([
            'modulo_id' => 9,
            'nome' => 'Cadastro de Serviços',
            'slug' => 'tela-cadastro-de-servicos',
            'descricao' => 'Tela de Qualidade de Dados de Cadastro de Serviços'
        ]);

        Tela::create([
            'modulo_id' => 9,
            'nome' => 'Gestão de Documentos',
            'slug' => 'tela-gestao-de-documentos',
            'descricao' => 'Tela de Qualidade de Dados de Gestão de Documentos'
        ]);

        Tela::create([
            'modulo_id' => 9,
            'nome' => 'Cadastro de Fornecedores',
            'slug' => 'tela-cadastro-de-fornecedores',
            'descricao' => 'Tela de Qualidade de Dados de Cadastro de Fornecedores'
        ]);
    }
}
