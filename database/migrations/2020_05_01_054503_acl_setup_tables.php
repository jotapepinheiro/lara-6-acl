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
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('perfil_usuario', function (Blueprint $table) {
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
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('modulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
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
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('permissao_perfil_tela', function (Blueprint $table) {
            $table->bigInteger('permissao_id')->unsigned();
            $table->bigInteger('perfil_id')->unsigned();
            $table->bigInteger('tela_id')->unsigned();

            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('perfil_id')->references('id')->on('perfis')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tela_id')->references('id')->on('telas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permissao_id', 'perfil_id', 'tela_id']);
        });

        Schema::create('permissao_tela', function (Blueprint $table) {
            $table->bigInteger('permissao_id')->unsigned();
            $table->bigInteger('tela_id')->unsigned();

            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tela_id')->references('id')->on('telas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permissao_id', 'tela_id']);
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
        Schema::drop('permissao_tela');
        Schema::drop('permissao_perfil_tela');
        Schema::drop('permissoes');
        Schema::drop('modulo_tela');
        Schema::drop('modulos');
        Schema::drop('telas');
        Schema::drop('perfil_usuario');
        Schema::drop('perfis');
    }
}
