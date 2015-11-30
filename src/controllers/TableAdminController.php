<?php

namespace Vis\Builder;

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

        $tree = $model::all()->toHierarchy();

        $idNode  = \Input::get('node', 1);
        $current = $model::find($idNode);

        $parentIDs = array();
        foreach ($current->getAncestors() as $anc) {
            $parentIDs[] = $anc->id;
        }

        return View::make('admin::tree.tree')
                ->with("tree", $tree)
                ->with("parentIDs", $parentIDs);
    }

    public function showUsers()
    {
        $options = array(
            'url'    => '/admin/tb/users',
            'def_name' => 'users',
        );

        $table = JarboeFacade::create($options)['showList'];

        if (Request::ajax()) {
            return $table;
        }

        $view = View::make('admin::table')->with('table', $table);
        return $view;
    } // end showUsers

    public function handleUsers()
    {
        $options = array(
            'url'    => '/admin/tb/users',
            'def_name' => 'users',
        );

        return JarboeFacade::create($options);
    } // end handleUsers

    public function showGroups()
    {
        $options = array(
            'url'    => '/admin/tb/groups',
            'def_name' => 'groups',
        );

        $table = JarboeFacade::create($options)['showList'];

        if (Request::ajax()) {
            return $table;
        }

        $view = View::make('admin::table')->with('table', $table);

        return $view;
    } // end showGroups

    public function handleGroups()
    {
        $options = array(
            'url'    => '/admin/tb/groups',
            'def_name' => 'groups',
        );

        return JarboeFacade::create($options);
    } // end handleGroups

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
