<?php namespace Vis\Builder;

use Vis\Builder\Facades\Jarboe as JarboeFacade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;

class TableAdminController extends \BaseController
{
    public function showTree()
    {
        $controller = JarboeFacade::tree();

        return $controller->handle();
    } // end showTree

    public function showTreeOther($nameTree)
    {
        $model = Config::get('builder::' . $nameTree . '_tree.model');
        $option = [];

        $controller = JarboeFacade::tree($model, $option, $nameTree."_tree");

        return $controller->handle();
    }

    public function handleTree()
    {

        $controller = JarboeFacade::tree();

        return $controller->process();
    } // end handleTree

    public function handleTreeOther($nameTree)
    {
        $model = Config::get('builder::' . $nameTree . '_tree.model');
        $option = [];

        $controller = JarboeFacade::tree($model, $option, $nameTree."_tree");

        return $controller->process();
    } // end handleTree


    public function showTreeAll($nameTree)
    {
        $model = Config::get('builder::' . $nameTree . '.model');
        $tree = $model::where("parent_id", 0)->orwhereNull("parent_id")->get(array('id', 'title', 'parent_id'));

        return View::make('admin::tree.tree')->with("tree", $tree);
    }

    public function showPage($page)
    {
        $options = array(
            'url'      => '/admin/'.$page,
            'def_name' => $page,
        );

        $table = JarboeFacade::table($options)['showList'];
        $view = View::make('admin::table', compact('table'));

        return $view;
    }

    public function showPagePost($page)
    {
        $options = array(
            'url'      => '/admin/'.$page,
            'def_name' => $page,
        );

        return JarboeFacade::table($options)['showList'];
    }

    public function handlePage($page)
    {
        $options = array(
            'url'      => '/admin/'.$page,
            'def_name' => $page,
        );
        return JarboeFacade::table($options);
    } // end handleСases


}
