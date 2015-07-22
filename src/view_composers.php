<?php

View::composer('admin::partials.navigation', function($view) {
    $user = Sentry::getUser();
    $menu = Config::get('builder::admin.menu');

    $view->with('user', $user)->with("menu", $menu);
});

View::composer(array('admin::layouts.default', 'admin::partials.scripts'), function($view) {

    $skin = Cookie::get('skin') ? : "smart-style-4";
    $thisLang = Cookie::get("lang_admin") ? : Config::get("builder::translate_cms.lang_default");

    $view->with('skin', $skin)->with("thisLang", $thisLang);
});
