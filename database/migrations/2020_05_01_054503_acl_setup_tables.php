<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

        /**
         * TABELAS ACL
         */

        Schema::create('perfis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        Schema::create('permissoes', function (Blueprint $table) {
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

        Schema::create('telas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        /**
         * TABELAS ACL PIVOS
         */

        Schema::create('perfil_permissao', function (Blueprint $table) {
            $table->bigInteger('perfil_id')->unsigned();
            $table->bigInteger('permissao_id')->unsigned();

            $table->foreign('perfil_id')->references('id')->on('perfis')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['perfil_id', 'permissao_id']);
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

        Schema::create('usuario_permissao', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('permissao_id');

            $table->foreign('usuario_id')->references('id')->on('usuarios')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['usuario_id', 'permissao_id']);
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

        Schema::create('tela_permissao', function (Blueprint $table) {
            $table->unsignedBigInteger('tela_id');
            $table->unsignedBigInteger('permissao_id');

            $table->foreign('tela_id')->references('id')->on('telas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permissao_id')->references('id')->on('permissoes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['tela_id', 'permissao_id']);
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

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        // PIVOS
        Schema::dropIfExists('perfil_tela_permissao');
        Schema::dropIfExists('tela_permissao');
        Schema::dropIfExists('modulo_tela');
        Schema::dropIfExists('usuario_permissao');
        Schema::dropIfExists('usuario_perfil');
        Schema::dropIfExists('perfil_permissao');

        // TABELAS
        Schema::dropIfExists('telas');
        Schema::dropIfExists('modulos');
        Schema::dropIfExists('permissoes');
        Schema::dropIfExists('perfis');
    }
}
