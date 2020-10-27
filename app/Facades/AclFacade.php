<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AclFacade
 *
 * @method static bool hasRole(string $role, bool $requireAll)
 * @method static bool can(string $permission, bool $requireAll)
 * @method static bool ability(array|string $roles, array|string $permissions, array $options = [])
 *
 * @package App\Facades
 */
class AclFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'acl';
    }
}
