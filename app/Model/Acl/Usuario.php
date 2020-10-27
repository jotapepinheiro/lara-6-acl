<?php

namespace App\Model\Acl;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Facades\AclFacade as Acl;
use App\Traits\AclUsuarioTrait;

class Usuario extends Authenticatable
{
    use Notifiable;
    //use HasPermissoesTrait;
    use AclUsuarioTrait {
        can as platformCan;
    }

    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define all permissions for role Super Admin
     *
     * @param string $permission
     * @param bool $requireAll
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        if (Acl::hasRole('super', $requireAll)) {
            return true;
        }

        return $this->platformCan($permission, $requireAll);
    }
}
