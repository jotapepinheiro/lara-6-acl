<?php

namespace App\Model\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return HasMany
     */
    public function telas() {
        return $this->hasMany(Tela::class, 'modulo_id');
    }

    /**
     * @return BelongsTo
     */
    public function pai() {
        return $this->belongsTo(self::class, 'modulo_id', 'id');
    }
}
