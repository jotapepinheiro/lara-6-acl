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

        Tela::create([
            'nome' => 'Obrigações',
            'slug' => 'obrigacoes',
            'descricao' => 'Tela de Obrigações'
        ]);

        Tela::create([
            'nome' => 'Gestão de Atividades',
            'slug' => 'gestao-de-atividades',
            'descricao' => 'Tela de Gestão de Atividades'
        ]);

        Tela::create([
            'nome' => 'Atividades',
            'slug' => 'atividades',
            'descricao' => 'Tela de Atividades'
        ]);
    }
}
