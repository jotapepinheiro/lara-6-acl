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

        Modulo::create([
            'nome' => 'Calendário',
            'slug' => 'calendario',
            'descricao' => 'Módulo de Calendário'
        ]);

        Modulo::create([
            'nome' => 'Conteúdo',
            'slug' => 'conteudo',
            'descricao' => 'Módulo de Conteúdo'
        ]);

    }
}
