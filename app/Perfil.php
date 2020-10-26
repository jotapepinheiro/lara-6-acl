<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfis';

    protected $hidden = array('pivot');

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];

    public function permissoes() {
        return $this->belongsToMany(Permissao::class, 'perfil_permissao');
    }

    public function usuarios() {
        return $this->belongsToMany(Usuario::class, 'usuario_perfil');
    }

}
