<?php

namespace App\Traits\Acl;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Model\Acl\Permissao;
use App\Model\Acl\Perfil;

trait AclPermissaoTrait
{
    /**
     * @return BelongsToMany
     */
    public function perfis() {
        return $this->belongsToMany(Perfil::class, 'perfil_permissao', 'permissao_id', 'perfil_id');
    }

    /**
     * Anexe ouvinte de evento para remover os registros muitos para muitos ao tentar excluir
     * NÃO excluirá nenhum registro se o modelo de permissão usar exclusões reversíveis.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($permissao) {
            if (!method_exists(Permissao::class, 'bootSoftDeletes')) {
                $permissao->perfis()->sync([]);
            }

            return true;
        });
    }
}
