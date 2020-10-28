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

    protected $hidden = array('pivot');

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];

    public function telas() {
        return $this->belongsToMany(Tela::class, 'modulo_tela', 'modulo_id', 'tela_id');
    }

}
