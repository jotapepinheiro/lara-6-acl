<?php

namespace App\Providers;

use App\Services\Acl;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->bladeDirectives();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAcl();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        // Call to Acl::hasRole
        Blade::directive('role', function($expression) {
            return "<?php if (\\Acl::hasRole({$expression})) : ?>";
        });

        Blade::directive('endrole', function($expression) {
            return "<?php endif; // Acl::hasRole ?>";
        });

        // Call to Acl::can
        Blade::directive('permission', function($expression) {
            return "<?php if (\\Acl::can({$expression})) : ?>";
        });

        Blade::directive('endpermission', function($expression) {
            return "<?php endif; // Acl::can ?>";
        });

        // Call to Acl::ability
        Blade::directive('ability', function($expression) {
            return "<?php if (\\Acl::ability({$expression})) : ?>";
        });

        Blade::directive('endability', function($expression) {
            return "<?php endif; // Acl::ability ?>";
        });
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerAcl()
    {
        $this->app->bind('acl', function ($app) {
            return new Acl($app);
        });

        $this->app->alias('acl', 'App\Services\Acl');
    }

}
