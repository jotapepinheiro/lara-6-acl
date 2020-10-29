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

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];

    public function permissoes() {
        return $this->hasMany(Permissao::class, 'tela_id');
    }
}
