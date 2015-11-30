<?php namespace Vis\Builder;

use Illuminate\Support\ServiceProvider;
use Vis\Builder\Commands\PrepareArtisanCommand;
use Vis\Builder\Commands\CreateAdminUserArtisanCommand;
use Vis\Builder\Commands\CreateSuperUserArtisanCommand;
use Vis\Builder\Commands\CreateDefinitionArtisanCommand;
use Vis\Builder\Commands\InstallArtisanCommand;

class BuilderServiceProvider extends ServiceProvider {

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
        $this->package('vis/builder');

        include __DIR__.'/../../helpers.php';
        include __DIR__.'/../../filters.php';
        include __DIR__.'/../../routes.php';
        include __DIR__.'/../../view_composers.php';

        include __DIR__.'/../../events/settings.php';
        include __DIR__.'/../../events/users.php';
        include __DIR__.'/../../events/translate.php';
        include __DIR__.'/../../events/table.php';


        $this->app['config']->package('builder', app_path().'/config/packages/vis/builder/', "builder");

        \View::addNamespace('admin', __DIR__.'/../../views/');
    } // end boot

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['jarboe'] = $this->app->share(function($app) {
            return new Jarboe();
        });

        $this->doCommandsRegister();
    } // end register

    private function doCommandsRegister()
    {
     
        $this->app['command.jarboe.install'] = $this->app->share(
            function ($app) {
                return new InstallArtisanCommand();
            }
        );
      
        $this->commands(array(
            'command.jarboe.install',
        ));
    } // end doCommandsRegister

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'command.jarboe.install',
            'command.jarboe.create_admin_user'
        );
    }


}
