<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AclFacade
 *
 * @method static bool hasRole(array|string $role, bool $requireAll = false)
 * @method static bool can(string $permission, bool $requireAll = false)
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
