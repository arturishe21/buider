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

