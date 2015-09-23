<?php

namespace Vis\Builder;

use Vis\Builder\Helpers\URLify;
use Vis\Builder\NavigationMenu;
use Vis\Builder\DefinitionMaker;
use Vis\Builder\TreeController;
use Vis\Builder\Exceptions\JarboeValidationException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Yandex\Translate\Translator;
use Yandex\Translate\Exception;


class Jarboe 
{

    protected $controller;
    protected $default;

    protected function onInit($options)
    {
        $this->controller = new JarboeController($options);

    } // end onInit

    protected function onFinish()
    {
        Config::set('view.pagination', $this->default['pagination']);
        Config::set('database.fetch', $this->default['fetch']);
    } // end onFinish

    public function table($options)
    {
        $this->onInit($options);
     //  DB::beginTransaction();

        try {

            $result = $this->controller->handle();

        } catch (JarboeValidationException $e) {
          //  DB::rollback();

            $data = array(
                'status' => false,
                'errors' => explode('|', $e->getMessage())
            );
            return Response::json($data);
        }

       // DB::commit();
       // $this->onFinish();

        return $result;
    } // end table
    
    /*
     * @deprecated
     */
    public function create($options)
    {
        return $this->table($options);
    } // end create

    public function createDefinition($table)
    {
        $maker = new DefinitionMaker($table);

        return $maker->create();
    } // end createDefinition

    public function checkNavigationPermissions()
    {
        $menu = new NavigationMenu();
        $menu->checkPermissions();
    } // end checkNavigationPermissions

    public function urlify($string)
    {
        return URLify::filter($string);
    } // end urlify

    public function tree($model = 'Vis\Builder\Tree', $options = array())
    {
        $controller = new TreeCatalogController($model, $options);

        return $controller;
    } // end tree



}

