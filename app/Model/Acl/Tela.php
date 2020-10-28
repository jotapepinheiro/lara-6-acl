<?php

namespace App\Model\Acl;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tela
 *
 * @package App\Model\Acl
 */
class Tela extends Model
{
    protected $table = 'telas';

    protected $hidden = array('pivot');

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];

    public function permissoes() {
        return $this->belongsToMany(Permissao::class, 'tela_permissao', 'tela_id', 'permissao_id');
    }
}
