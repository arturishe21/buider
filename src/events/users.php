<?php

use Vis\Builder\Event as EventModel;

Event::listen("user.login", function(){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Пользователь id" . Sentry::getUser()->id . " вошел в админку",
        "model" => get_class(Sentry::getUser()),
        "id_record" => Sentry::getUser()->id,
        "action" => "login"
    ));
});

Event::listen("user.logout", function(){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Пользователь id#" . Sentry::getUser()->id . " вышел из админки",
        "model" => get_class(Sentry::getUser()),
        "id_record" => Sentry::getUser()->id,
        "action" => "logout"
    ));
});

Event::listen("user.login_error", function(){
    EventModel::create(array(
        "id_user" => 0,
        "ip_user" => Request::getClientIp(true),
        "message" => "Ошибка входа в админку",
        "model" => "User",
        "id_record" => 0,
        "action" => "error_login"
    ));
});

