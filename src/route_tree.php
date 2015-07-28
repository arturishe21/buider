<?php

/**
 *  recurse create url for tree
 *  @return string
 */
function recurseMyTree($tree, $node, &$slugs = array()) {
    if (!$node['parent_id']) {
        return $node['slug'];
    }

    $slugs[] = $node['slug'];
    $idParent = $node['parent_id'];
    if ($idParent) {
        $parent = $tree[$idParent];
        recurseMyTree($tree, $parent, $slugs);
    }

    return implode('/', array_reverse($slugs));
}

// tree is active
if (Config::get('builder::tree.is_active')) {
    try {

        $_tbTree = Cache::tags(array('jarboe', 'j_tree'))->rememberForever('j_tree', function() {
            $_model = Config::get('builder::tree.model');


            if (!class_exists($_model)) {
                return "";
            }

            $_tbTree  = $_model::all();
            $_clone   = $_tbTree->toArray();

            foreach ($_clone as $cl) {
                $_clone[$cl['id']] = $cl;
            }
            foreach ($_tbTree as $node) {
                //create and set url
                $_nodeUrl = recurseMyTree($_clone, $node);
                $node->setUrl($_nodeUrl);
            }

            return $_tbTree;
        });

        $templates = Config::get('builder::tree.templates');

        if (isset($_tbTree) && count($_tbTree)) {

            foreach ($_tbTree as $node) {
                //create and set url
                $_nodeUrl = $node->getUrlNoLocation();

                Route::group(array('prefix' => LaravelLocalization::setLocale()), function() use ($node, $_nodeUrl, $templates)
                {
                    Route::get($_nodeUrl, function() use ($node, $templates)
                    {
                        if (!isset($templates[$node->template])) {
                            App::abort(404);
                        }
                        list($controller, $method) = explode('@', $templates[$node->template]['action']);

                        $app = app();
                        $controller = $app->make($controller);
                        return $controller->callAction('init', array($node, $method));
                    });
                });
            }
        }

    } catch (Exception $e) {}

}