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
