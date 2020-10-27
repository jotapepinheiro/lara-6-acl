<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Cache\TaggableStore;
use App\Model\Acl\Permissao;
use App\Model\Acl\Usuario;
use App\Model\Acl\Perfil;

trait AclPerfilTrait
{
    //Big block of caching functionality.
    public function cachedPermissions()
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'acl_permissoes_do_perfil_' . $this->$rolePrimaryKey;
        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags('perfil_permissao')->remember($cacheKey, now()->addMinutes(60), function () {
                return $this->permissoes()->get();
            });
        } else return $this->permissoes()->get();
    }

    public function save(array $options = [])
    {   //both inserts and updates
        if (!parent::save($options)) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags('perfil_permissao')->flush();
        }
        return true;
    }

    public function delete(array $options = [])
    {   //soft or hard
        if (!parent::delete($options)) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags('perfil_permissao')->flush();
        }
        return true;
    }

    public function restore()
    {   //soft delete undo's
        if (!parent::restore()) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags('perfil_permissao')->flush();
        }
        return true;
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return BelongsToMany
     */
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_perfil', 'perfil_id', 'usuario_id');
    }

    /**
     * Many-to-Many relations with the permission model.
     * Named "perms" for backwards compatibility. Also because "perms" is short and sweet.
     *
     * @return BelongsToMany
     */
    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class, 'perfil_permissao', 'perfil_id', 'permissao_id');
    }

    /**
     * Boot the role model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the role model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            if (!method_exists(Perfil::class, 'bootSoftDeletes')) {
                $role->usuarios()->sync([]);
                $role->permissoes()->sync([]);
            }

            return true;
        });
    }

    /**
     * Checks if the role has a permission by its name.
     *
     * @param string|array $slug Permission name or array of permission names.
     * @param bool $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function hasPermission($slug, $requireAll = false)
    {
        if (is_array($slug)) {
            foreach ($slug as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the permissions were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the permissions were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->cachedPermissions() as $permission) {
                if ($permission->slug == $slug) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Save the inputted permissions.
     *
     * @param mixed $inputPermissions
     *
     * @return void
     */
    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->permissoes()->sync($inputPermissions);
        } else {
            $this->permissoes()->detach();
        }

        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags('perfil_permissao')->flush();
        }
    }

    /**
     * Attach permission to current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            return $this->attachPermissions($permission);
        }

        $this->permissoes()->attach($permission);
    }

    /**
     * Detach permission from current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            return $this->detachPermissions($permission);
        }

        $this->permissoes()->detach($permission);
    }

    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Detach multiple permissions from current role
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions = null)
    {
        if (!$permissions) $permissions = $this->permissoes()->get();

        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }
}
