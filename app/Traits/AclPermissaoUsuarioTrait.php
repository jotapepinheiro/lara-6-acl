<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Facades\AclFacade as Acl;
use App\Model\Acl\Permissao;

trait AclPermissaoUsuarioTrait
{
    use AclUsuarioTrait {
        can as platformCan;
    }

    /**
     * Many-to-Many relations with Permission.
     *
     * @return BelongsToMany
     */
    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class, 'usuario_permissao', 'usuario_id', 'permissao_id');
    }

    /**
     * Check if user has a permission by its name.
     *
     * @param string|array $permission Permission string or array of permissions.
     * @param bool         $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        if (Acl::hasRole('super', $requireAll)) {
            return true;
        }

        // Check specific permissions first because permissions override roles
        $permFound = false;

        $permissionArray = is_array($permission) ? $permission : [$permission];
        $getUserPermissions = $this->permissoes->pluck('slug');

        foreach($getUserPermissions as $userPerm)
        {
            if(in_array($userPerm, $permissionArray))
            {
                $permFound = true;

                if(!$requireAll)
                {
                    break;
                }
            }
            else
            {
                $permFound = false;

                if($requireAll)
                {
                    break;
                }
            }
        }

        if($permFound)
        {
            return $permFound;
        }

        return $this->platformCan($permission, $requireAll);
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $permission
     */
    public function attachPermission($permission)
    {
        if(is_object($permission)) {
            $permission = $permission->getKey();
        }

        if(is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissoes()->attach($permission);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $permission
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissoes()->detach($permission);
    }

    /**
     * Attach multiple permissions to a user
     *
     * @param mixed $permissions
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Detach multiple permissions from a user
     *
     * @param mixed $permissions
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

}
