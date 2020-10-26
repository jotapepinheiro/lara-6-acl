<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes';

    protected $hidden = array('pivot');

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];

    public function perfis() {
        return $this->belongsToMany(Perfil::class, 'perfil_permissao');
    }

    public function usuarios() {
        return $this->belongsToMany(Usuario::class, 'usuario_permissao');
    }

    public function telas() {
        return $this->belongsToMany(Tela::class, 'perfil_tela_permissao');
    }

}
