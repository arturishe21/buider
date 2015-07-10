<?php

namespace Vis\Builder;

use Controller, View, Redirect, Config, Input, Cookie, Response, Session, Lang;
use Sentry;

class TBController extends Controller
{

    public function showDashboard()
    {
       return Redirect::to("/admin/tree");
        //return View::make('admin::dashboard');
    } // end showDashboard

    public function doChangeSkin()
    {
        $skin = Input::get('skin');
        Cookie::queue('skin', $skin, "100000");
    }
    public function doChangeLangAdmin()
    {
        $lang = Input::get('lang');
        Cookie::queue('lang_admin', $lang, "100000000");

        return Redirect::back();
    }

    public function fetchByUrl()
    {
        $url = Input::get('url');

        $embera = new \Embera\Embera();
        $info = $embera->getUrlInfo($url);
        
        $info['status'] = true;
        
        return Response::json($info);
    } // end fetchByUrl
    
    public function doEmbedToText()
    {
        $text = Input::get('text');

        $config = array(
            'params' => array(
                'width'  => 640,
                'height' => 360
            )
        );
        $embera = new \Embera\Embera($config);
        $res = $embera->autoEmbed($text);
        
        $info = array(
            'status' => true,
            'html' => $res
        );
        return Response::json($info);
    } // end doEmbedToText
    
    public function getInformNotification()
    {
        $index = Input::get('index');
        $informer = new Informer();
        
        $data = array(
            'status' => true,
            'html'   => $informer->getContentByIndex($index)
        );
        return Response::json($data);
    } // end getInformNotification
    
    public function getInformNotificationCounts()
    {
        $informer = new Informer();
        list($total, $counts) = $informer->getCounts();
        
        $data = array(
            'status' => true,
            'total'  => $total,
            'counts' => $counts,
        );
        return Response::json($data);
    } // end getInformNotificationCounts
    
    public function doSaveMenuPreference()
    {
        $option = Input::get('option');
        $cookie = Cookie::forever('tb-misc-body_class', $option);
        
        $data = array(
            'status' => true
        );
        $response = Response::json($data);
        $response->headers->setCookie($cookie);
        
        return $response;
    } // end doSaveMenuPreference

}