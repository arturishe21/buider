<?php

View::composer(array('partials.footer', 'partials.header'), function($view) {

    $menu = Cache::tags(array('jarboe', 'j_tree'))->rememberForever('menu', function() {
        $menu = Tree::isMenu()->get();

        return $menu;
    });

    $view->with('menu', $menu);
});

View::composer('partials.last_articles', function($view) {

    $lastAricles = Articles::active()->take(4)->get();

    $view->with('lastAricles', $lastAricles);
});

View::composer('partials.slider_main', function($view) {

    $sliders = Slider::active()->get();

    $view->with('sliders', $sliders);
});

View::composer('partials.breadcrumbs', function($view) {

    if (!isset($view->getData()['page'])) {
        return "Не передан параметр";
    }
    $page = $view->getData()['page'];

    //if node
    if( get_class($page) == "Tree") {
        $breadcrumbs = new Breadcrumbs($page);
    } else {

        $node = $page->getNode();
        $breadcrumbs = new Breadcrumbs($node);
        $breadcrumbs->add($page->getUrl(), $page->title);
    }


    $view->with('breadcrumbs', $breadcrumbs);
});