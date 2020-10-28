<?php

namespace App\Model\Acl;

use App\Repositories\Contracts\AclPermissaoInterface;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AclPermissaoTrait;

/**
 * Class Permissao
 *
 * @package App\Model\Acl
 */
class Permissao extends Model implements AclPermissaoInterface
{
    use AclPermissaoTrait;

    protected $table = 'permissoes';

    protected $hidden = array('pivot');

    protected $fillable = [
        'nome', 'slug', 'descricao'
    ];
}
