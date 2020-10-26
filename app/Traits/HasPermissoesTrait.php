<?php
namespace App\Traits;

use App\Permissao;
use App\Perfil;

trait HasPermissoesTrait {

    public function perfis() {
        return $this->belongsToMany(Perfil::class,'usuario_perfil');
    }

    public function permissoes() {
        return $this->belongsToMany(Permissao::class,'usuario_permissao');
    }

    // PERFIS

    // Parâmetro: perfis. Ex: $user->hasPerfil('admin', 'super')
    // Checar se o user atual detem uma dos perfis especificados
    // Retorno: true/false
    public function hasPerfil( ... $perfis ) {
        foreach ($perfis as $perfil) {
            if ($this->perfis->contains('slug', $perfil)) {
                return true;
            }
        }
        return false;
    }

    public function withPerfil() {
        return $this->perfis;
    }


    // Retorna todas os perfis cadastrados em 'perfis'
    // Parâmetro: nenhum
    // Exemplo: $user->allPerfis()
    public function allPerfis() {
        return Perfil::get('nome', 'slug', 'descricao');
    }

    protected function getAllPerfis(array $perfis) {
        return Perfil::whereIn('slug', $perfis)->get();
    }

    // Criar um perfil a ser gravado em 'perfis'
    // Parâmetros: $nome, $slug e $descricao do perfil a ser criado
    // Sem retorno, grava e mostra na tela o perfil criado
    public function createPerfil($nome, $slug, $descricao){
        $perfil = Perfil::create([
            'nome' => $nome,
            'slug' => $slug,
            'descricao' => $descricao,
        ]);
        return $perfil;
    }

    // Parâmetro: perfis. Ex: $user->givePerfisTo('editor','author')// os perfis já devem estar em 'perfis' e serão atribuidos ao usuario locado
    // Atribuir perfis para o usuario atual, gravados na tabela usuario_perfil
    // Sem retorno. Grava os perfis na tabela usuario_perfil para o usuario atual
    public function givePerfisTo( ... $perfis) {
        $perfis = $this->getAllPerfis($perfis);
        if($perfis === null) {
            return $this;
        }
        $this->perfis()->saveMany($perfis);
        return $this;
    }

    // Remove um ou mais perfis do usuario atual, que estão em usuario_perfil
    // Parãmetros: perfis. Ex: $user->deletePerfis('admin', 'user')
    // Sem retorno. Grava as informações na tabela e mostra na tela dados do usuario atual
    public function deletePerfis( ... $perfis ) {
        $perfis = $this->getAllPerfis($perfis);
        $this->perfis()->detach($perfis);
        return $this;
    }

    // PERMISSOES

    // Retorna todas as permissoes cadastradas em 'permissoes'
    // Parâmetro: nenhum
    // Exemplo: $user->allPermissoes()
    public function allPermissoes() {
        return Permissao::get('nome', 'slug', 'descricao');
    }

    // Permissoes de usuario
    protected function hasPermissao($permissao) {
        return (bool) $this->permissoes->where('slug', $permissao)->count();
    }

    // Parâmetro: permissao. $user->hasPermissaoThroughPerfil('clients-index'). As permissões devem estar em 'permissoes'
    // Checar se o usuario atual detem a permissao citada
    // Retorno true/false
    public function hasPermissaoThroughPerfil($permissao) {
        foreach ($permissao->perfis as $perfil){
            if($this->perfis->contains($perfil)) {
                return true;
            }
        }
        return false;
    }

    // Parâmetro: permissao. $user->hasPermissaoTo('clients-index'). As permissões devem estar em 'permissoes'
    // Checar se o usuario atual detem a permissao citada
    // Retorno true/false
    public function hasPermissaoTo($permissao) {
        return (bool) $this->hasPermissaoThroughPerfil($permissao) || $this->hasPermissao($permissao);
    }

    // Criar uma permissao a ser gravada em 'permissoes'
    // Parâmetros: $nome, $slug e $descricao da permissao a ser criada
    // Sem retorno, grava e mostra na tela a permissao criada
    public function createPermissao($nome, $slug, $descricao){
        $permissao = Permissao::create([
            'nome' => $nome,
            'slug' => $slug,
            'descricao' => $descricao,
        ]);
        return $permissao;
    }

    protected function getAllPermissoes(array $permissoes) {
        return Permissao::whereIn('slug', $permissoes)->get();
    }

    // Parâmetro: $permissoes. Ex: $user->givePermissoesTo('clients-index','clients-edit')// as permissões já devem estar em 'permissoes'
    // Grava permissões para o usuario atual, na tabela usuario_permissao
    // Sem retorno. Grava as permissões na tabela usuario_permissao para o usuario atual
    public function givePermissoesTo( ... $permissoes) {
        $permissoes = $this->getAllPermissoes($permissoes);
        if($permissoes === null) {
            return $this;
        }
        $this->permissoes()->saveMany($permissoes);
        return $this;
    }

    // Remove uma ou mais permissões do usuario atual, que estão em usuario_permissao
    // Parãmetros: permissões. Ex: $user->deletePermissoes('clients-index', 'clients-edit')
    // Sem retorno. Grava as informações na tabela e mostra na tela dados do usuario atual
    public function deletePermissoes( ... $permissoes ) {
        $permissoes = $this->getAllPermissoes($permissoes);
        $this->permissoes()->detach($permissoes);
        return $this;
    }
}
