<?php
namespace App\Providers;

use App\Model\Acl\Permissao;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissoesServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            Permissao::get()->map(function ($permissao) {
                Gate::define($permissao->slug, function ($user) use ($permissao) {
                    return $user->hasPermissaoTo($permissao);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        //Blade directives
        Blade::directive('perfil', function ($perfil) {
            return "<?php if(auth()->check() && auth()->user()->hasPerfil({$perfil})) : ?>";
        });

        Blade::directive('endPerfil', function ($perfil) {
            return "<?php endif; ?>";
        });
    }
}
