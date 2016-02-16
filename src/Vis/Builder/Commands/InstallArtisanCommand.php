<?php

namespace Vis\Builder\Commands;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InstallArtisanCommand extends Command
{
    protected $name = 'tb:install';

    protected $description = 'Installation basic cms';

    public function fire()
    {


        // if ($this->confirm('Start install? [y|n]')) {

        //create table with sql
        if(!File::exists(app_path() . '/models/Tree.php')) {
            $f = scandir(__DIR__ . '/../../../dump_sql_table/');
            foreach ($f as $file) {
                if (preg_match('/\.(sql)/', $file)) {
                    $this->info("Processed file " . $file);
                    DB::unprepared(file_get_contents(__DIR__
                            . '/../../../dump_sql_table/' . $file));
                }
            }
        }


        //create folder 'public/css/builds'
        if (!is_dir(public_path() . '/css/builds')) {
            File::makeDirectory(public_path() . '/css/builds', 0777, true);
            $this->info('Folder /css/builds is created');
        }
        //create folder 'public/js/builds'
        if (!is_dir(public_path() . '/js/builds')) {
            File::makeDirectory(public_path() . '/js/builds', 0777, true);
            $this->info('Folder /js/builds is created');
        }

        //replace htaccess
      //  if(!File::exists(public_path() . '/.htaccess')) {
            copy(
                __DIR__ . '/../../../misc/.htaccess',
                public_path() . '/.htaccess'
            );
            $this->info('Replace htaccess - OK');
        //}

        //replace HomeController
        if(!File::exists(app_path() . '/controllers/HomeController.php')) {
            copy(
                __DIR__ . '/../../../misc/HomeController.php',
                app_path() . '/controllers/HomeController.php'
            );
            $this->info('Replace HomeController.php - OK');
        }

        //replace router.php
        //if(!File::exists(app_path() . '/routes.php')) {
            copy(
                __DIR__ . '/../../../misc/routes.php',
                app_path() . '/routes.php'
            );
            $this->info('Replace routes.php - OK');
       // }



        //replace view_composers.php
        if(!File::exists(app_path() . '/view_composers.php')) {
            copy(
                __DIR__ . '/../../../misc/view_composers.php',
                app_path() . '/view_composers.php'
            );
            $this->info('Replace view_composers.php - OK');
        }

        //create folder mcamara/laravel-localization'
        if (!is_dir(app_path() . '/config/packages/mcamara/laravel-localization')) {
            File::makeDirectory(app_path() . '/config/packages/mcamara/laravel-localization', 0777, true);
            $this->info('Folder /config/packages/mcamara/laravel-localization is created');

            copy(
                __DIR__ . '/../../../misc/localization_config.php',
                app_path() . '/config/packages/mcamara/laravel-localization/config.php'
            );
            $this->info('Replace laravel-localization/config.php - OK');
        }

        if (!is_dir(app_path() . '/config/packages/intervention/imagecache')) {
            File::makeDirectory(app_path() . '/config/packages/intervention/imagecache', 0777, true);
            $this->info('Folder /config/packages/intervention/imagecache is created');

            copy(
                __DIR__ . '/../../../misc/imagecache_config.php',
                app_path() . '/config/packages/intervention/imagecache/config.php'
            );
            $this->info('Replace imagecache/config.php - OK');
        }


        //replace BaseModel.php
        if(!File::exists(app_path() . '/models/BaseModel.php')) {
            copy(
                __DIR__ . '/../../../misc/BaseModel.php',
                app_path() . '/models/BaseModel.php'
            );
            $this->info('Replace BaseModel.php - OK');
        }

        //replace News.php
        if(!File::exists(app_path() . '/models/News.php')) {
            copy(
                __DIR__ . '/../../../misc/News.php',
                app_path() . '/models/News.php'
            );
            $this->info('Replace News.php - OK');
        }

        //replace Tree.php
        if(!File::exists(app_path() . '/models/Tree.php')) {
            copy(
                __DIR__ . '/../../../misc/Tree.php',
                app_path() . '/models/Tree.php'
            );
            $this->info('Replace Tree.php - OK');
        }

        //replace User.php
       // if(!File::exists(app_path() . '/models/User.php')) {
            copy(
                __DIR__ . '/../../../misc/User.php',
                app_path() . '/models/User.php'
            );
            $this->info('Replace User.php - OK');
      //  }

        //replace Util.php
        if(!File::exists(app_path() . '/models/Util.php')) {
            copy(
                __DIR__ . '/../../../misc/Util.php',
                app_path() . '/models/Util.php'
            );
            $this->info('Replace Util.php - OK');
        }
        //replace Breadcrumbs.php
        if(!File::exists(app_path() . '/models/Breadcrumbs.php')) {
            copy(
                __DIR__ . '/../../../misc/Breadcrumbs.php',
                app_path() . '/models/Breadcrumbs.php'
            );
            $this->info('Replace Breadcrumbs.php - OK');
        }


        $this->call('asset:publish',
            array(
                'package' => 'vis/builder'
            ));

        if(!File::exists(app_path() . '/config/packages/vis/builder/admin.php')) {

            $this->call('config:publish',
                array(
                    'package' => 'vis/builder',
                ));
        }

        if(!File::exists(app_path() . '/config/packages/cartalyst/sentry/config.php')) {

            $this->call('config:publish',
                array(
                    'package' => 'cartalyst/sentry',
                ));
        }


        $this->call('cache:clear');

        $this->call('ide-helper:generate');
        //  }

        return;
    } // end fire

}
