<?php

try {
    $_model = Config::get('builder::tree.model');
    $arrSegments = explode("/", Request::path());
    $slug = end($arrSegments);
    $templates = Config::get('builder::tree.templates');

    if (!$slug || $slug == LaravelLocalization::setLocale()) {
        $slug = "/";
    }

    $nodes = $_model::where("slug", 'like', $slug)->get();

    foreach($nodes as $node) {

        if (isset($node->id)) {

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

            if (LaravelLocalization::setLocale() == "") {
                $pathUrl= "/".Request::path();
            } else {
                $pathUrl = Request::path();
            }

            if ($pathUrl == LaravelLocalization::setLocale().$_nodeUrl) {
                Session::put('currentNode', $node);
            }  else {
                Session::put('currentNode', $node);
            }
        }
    }

} catch (Exception $e) {}

/*
 * other tree
 */

$otherTreeUrl = Config::get('builder::tree.other_tree_url');
$startUrl = $arrSegments[0];

if ($arrSegments[0] == LaravelLocalization::setLocale()) {
    $startUrl = $arrSegments[1];
}

$urls = array_keys($otherTreeUrl);

if ($urls && count($urls) && in_array($startUrl, $urls)) {
    if (isset($otherTreeUrl[$startUrl])) {

        $configName = $otherTreeUrl[$startUrl];
        $model = Config::get("builder::" . $configName . ".model");
        $slug = end($arrSegments);
        $node = $model::where("slug", 'like', $slug)->first();

        if (isset($node->id)) {

            $_nodeUrl = $node->getUrlNoLocation();
            $templates = Config::get("builder::" . $configName . ".templates");


           Route::group(array('prefix' => LaravelLocalization::setLocale()), function () use ($node, $_nodeUrl, $templates) {
                Route::get($_nodeUrl, function () use ($node, $templates) {
                    if (!isset($templates[$node->template])) {
                        App::abort(404);
                    }

                    list($controller, $method) = explode('@',
                        $templates[$node->template]['action']);

                    $app = app();
                    $controller = $app->make($controller);

                    return $controller->callAction('init',
                        array($node, $method));
                });

            });

        }
    }
}

