<?php

namespace App\Model\Acl;

use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    protected $table = 'telas';

    protected $hidden = array('pivot');

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];

    public function permissoes() {
        return $this->belongsToMany(Permissao::class, 'perfil_tela_permissao');
    }
}
