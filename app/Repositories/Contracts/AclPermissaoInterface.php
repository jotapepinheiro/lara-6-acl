<?php

namespace App\Repositories\Contracts;

interface AclPermissaoInterface
{

    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perfis();
}
