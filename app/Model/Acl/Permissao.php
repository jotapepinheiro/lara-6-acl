<?php

namespace App\Model\Acl;

use App\Repositories\Contracts\AclPermissaoInterface;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AclPermissaoTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'tela_id', 'nome', 'slug', 'descricao'
    ];

    /**
     * @return BelongsTo
     */
    public function tela() {
        return $this->belongsTo(Tela::class, 'tela_id', 'id');
    }
}
