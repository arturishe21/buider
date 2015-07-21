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

        if ($this->confirm('Start install? [y|n]')) {

           //create table with sql
            $f = scandir(__DIR__ . '/../../../dump_sql_table/');
            foreach ($f as $file){
                if(preg_match('/\.(sql)/', $file)){
                    $this->info("Processed file ".$file);
                    DB::unprepared(file_get_contents(__DIR__ . '/../../../dump_sql_table/'.$file));
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
        copy(
            __DIR__ . '/../../../misc/.htaccess',
            public_path() . '/.htaccess'
        );
        $this->info('Replace htaccess - OK');

        //replace HomeController
        copy(
            __DIR__ . '/../../../misc/HomeController.php',
            app_path() . '/controllers/HomeController.php'
        );
        $this->info('Replace HomeController.php - OK');

        //replace router.php
        copy(
            __DIR__ . '/../../../misc/routes.php',
            app_path() . '/routes.php'
        );
        $this->info('Replace routes.php - OK');

        //replace view_composers.php
        copy(
            __DIR__ . '/../../../misc/view_composers.php',
            app_path() . '/view_composers.php'
        );
        $this->info('Replace view_composers.php - OK');


        //replace BaseModel.php
        copy(
            __DIR__ . '/../../../misc/BaseModel.php',
            app_path() . '/models/BaseModel.php'
        );
        $this->info('Replace BaseModel.php - OK');

        //replace News.php
        copy(
            __DIR__ . '/../../../misc/News.php',
            app_path() . '/models/News.php'
        );
        $this->info('Replace News.php - OK');

        //replace Tree.php
        copy(
            __DIR__ . '/../../../misc/Tree.php',
            app_path() . '/models/Tree.php'
        );
        $this->info('Replace Tree.php - OK');

        //replace Util.php
        copy(
            __DIR__ . '/../../../misc/Util.php',
            app_path() . '/models/Util.php'
        );
        $this->info('Replace Util.php - OK');

        //replace Breadcrumbs.php
        copy(
            __DIR__ . '/../../../misc/Breadcrumbs.php',
            app_path() . '/models/Breadcrumbs.php'
        );
        $this->info('Replace Breadcrumbs.php - OK');


        $this->call('asset:publish',
                    array(
                        'package' => 'vis/builder'
                    ));

        $this->call('config:publish',
                    array(
                        'package' => 'vis/builder',
                    ));

        $this->call('ide-helper:generate');

        return;

    } // end fire
    
}
