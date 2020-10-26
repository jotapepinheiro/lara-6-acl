<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AclSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('perfis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        Schema::create('usuario_perfil', function (Blueprint $table) {
            $table->bigInteger('usuario_id')->unsigned();
            $table->bigInteger('perfil_id')->unsigned();

            $table->foreign('usuario_id')->references('id')->on('usuarios')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('perfil_id')->references('id')->on('perfis')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['usuario_id', 'perfil_id']);
        });

        Schema::create('telas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        Schema::create('modulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        Schema::create('modulo_tela', function (Blueprint $table) {
            $table->bigInteger('modulo_id')->unsigned();
            $table->bigInteger('tela_id')->unsigned();

            $table->foreign('modulo_id')->references('id')->on('modulos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tela_id')->references('id')->on('telas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['modulo_id', 'tela_id']);
        });

        Schema::create('permissoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        Schema::create('perfil_tela_permissao', function (Blueprint $table) {
            $table->bigInteger('perfil_id')->unsigned();
            $table->bigInteger('tela_id')->unsigned();
            $table->bigInteger('permissao_id')->unsigned();

            $table->foreign('perfil_id')->references('id')->on('perfis')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tela_id')->references('id')->on('telas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['perfil_id', 'tela_id', 'permissao_id']);
        });

        Schema::create('perfil_permissao', function (Blueprint $table) {
            $table->bigInteger('perfil_id')->unsigned();
            $table->bigInteger('permissao_id')->unsigned();

            $table->foreign('perfil_id')->references('id')->on('perfis')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['perfil_id', 'permissao_id']);
        });

        Schema::create('usuario_permissao', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('permissao_id');

            $table->foreign('usuario_id')->references('id')->on('usuarios')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['usuario_id', 'permissao_id']);
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('usuario_permissao');
        Schema::drop('perfil_permissao');
        Schema::drop('perfil_tela_permissao');
        Schema::drop('permissoes');
        Schema::drop('modulo_tela');
        Schema::drop('modulos');
        Schema::drop('telas');
        Schema::drop('usuario_perfil');
        Schema::drop('perfis');
    }
}
