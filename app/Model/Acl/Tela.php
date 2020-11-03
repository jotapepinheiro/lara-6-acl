<?php

namespace App\Model\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Tela
 *
 * @package App\Model\Acl
 */
class Tela extends Model
{
    protected $table = 'telas';

    protected $fillable = [
        'modulo_id', 'nome', 'slug', 'descricao'
    ];

    /**
     * @return HasMany
     */
    public function permissoes() {
        return $this->hasMany(Permissao::class, 'tela_id');
    }

    /**
     * @return BelongsTo
     */
    public function modulo() {
        return $this->belongsTo(Modulo::class, 'modulo_id', 'id');
    }
}
