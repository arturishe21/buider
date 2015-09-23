<?php

use Vis\Builder\Event as EventModel;

Event::listen("setting.changed", function($settings){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Изменил настройку id#" . $settings->id,
        "model" => get_class($settings),
        "id_record" => $settings->id,
        "action" => "changed"
    ));
});

Event::listen("setting.delete", function($settings){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Удалил настройку id#" . $settings->id,
        "model" => get_class($settings),
        "id_record" => $settings->id,
        "action" => "deleted"
    ));
});

Event::listen("setting.created", function($settings){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Создал настройку id#" . $settings->id,
        "model" => get_class($settings),
        "id_record" => $settings->id,
        "action" => "created"
    ));
});
