<?php

use App\Model\Acl\Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->delete();

        /* 01 */
        Modulo::create([
            'nome' => 'Principal',
            'slug' => 'modulo-principal',
            'descricao' => 'Módulo Principal'
        ]);

        /* 02 */
        Modulo::create([
            'modulo_id' => 1,
            'nome' => 'Workflow',
            'slug' => 'modulo-workflow',
            'descricao' => 'Módulo de Workflow'
        ]);

        /* 03 */
        Modulo::create([
            'modulo_id' => 1,
            'nome' => 'Administração',
            'slug' => 'modulo-administracao',
            'descricao' => 'Módulo de Administração'
        ]);

        /* 04 */
        Modulo::create([
            'modulo_id' => 1,
            'nome' => 'Parâmetros',
            'slug' => 'modulo-parametros',
            'descricao' => 'Módulo de Parâmetros'
        ]);

        /* 05 */
        Modulo::create([
            'nome' => 'Complience',
            'slug' => 'modulo-complience',
            'descricao' => 'Módulo de Complience'
        ]);

        /* 06 */
        Modulo::create([
            'modulo_id' => 5,
            'nome' => 'Operações',
            'slug' => 'modulo-operacoes',
            'descricao' => 'Módulo de Operações'
        ]);

        /* 07 */
        Modulo::create([
            'nome' => 'Calendário',
            'slug' => 'modulo-calendario',
            'descricao' => 'Módulo de Calendário'
        ]);

        /* 08 */
        Modulo::create([
            'nome' => 'Conteúdo',
            'slug' => 'modulo-conteudo',
            'descricao' => 'Módulo de Conteúdo'
        ]);

        /* 09 */
        Modulo::create([
            'nome' => 'Qualidade de Dados',
            'slug' => 'modulo-qualidade-de-dados',
            'descricao' => 'Módulo de Qualidade de Dados'
        ]);

        /* 10 */
        Modulo::create([
            'nome' => 'Materiais',
            'slug' => 'modulo-materiais',
            'descricao' => 'Módulo de Materiais'
        ]);

    }
}
