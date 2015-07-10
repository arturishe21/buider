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

      /*  $this->default = array(
            'pagination' => Config::get('view.pagination'),
            'fetch' => Config::get('database.fetch')
        );
        Config::set('view.pagination', 'admin::tb.pagination');
        Config::set('database.fetch', \PDO::FETCH_ASSOC);*/
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

    public function translate($text, $language, $isHtml = false, $options = 0)
    {
        $key = Config::get('builder::translate.yandex_api_translation_key');
        if (!$key) {
            throw new \RuntimeException('Yandex api key for translations is not set');
        }

        $translator = new Translator($key);
        $translation = $translator->translate($text, $language, $isHtml, $options);

        // FIXME:
        return $translation->__toString();
    } // end translate

    public function tree($model = 'Vis\Builder\Tree', $options = array())
    {
        $controller = new TreeCatalogController($model, $options);

        return $controller;
    } // end tree

    public static function geo($ip = false)
    {
        if (!$ip) {
            $ip = \Request::getClientIp();
        }

        if ($ip == '127.0.0.1') {
            // HACK:
            $ip = '217.27.152.26';
        }

        $info = \DB::table('ip_geo_locations')->where('ip', $ip)->first();
        if ($info) {
            unset($info['id']);
            return $info;
        }

        $url = 'http://geoip.elib.ru/cgi-bin/getdata.pl?fmt=json&ip=';
        $json = file_get_contents($url . $ip);

        $info = json_decode($json, true);
        if (!$json || isset($info[$ip]['Error'])) {
            return false;
        }

        $data = array(
            'ip'        => $ip,
            'town'      => $info[$ip]['Town'],
            'latitude'  => $info[$ip]['Lat'],
            'longitude' => $info[$ip]['Lon'],
        );
        \DB::table('ip_geo_locations')->insert($data);

        return $data;
    } // end geo

}

