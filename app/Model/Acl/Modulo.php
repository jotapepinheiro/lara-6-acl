<?php

namespace App\Model\Acl;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Modulo
 *
 * @package App\Model\Acl
 */
class Modulo extends Model
{
    protected $table = 'modulos';

    protected $fillable = [
        'modulo_id', 'nome', 'slug', 'descricao'
    ];

    public function telas() {
        return $this->hasMany(Tela::class, 'modulo_id');
    }

}
