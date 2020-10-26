<?php

namespace App\Model\Acl;

use App\Repositories\Contracts\AclPerfilInterface;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AclPerfilTrait;

class Perfil extends Model implements AclPerfilInterface
{
    use AclPerfilTrait;

    protected $table = 'perfis';

    protected $hidden = array('pivot');

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];
}
