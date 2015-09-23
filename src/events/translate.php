<?php

use Vis\Builder\Event as EventModel;

Event::listen("translate.created", function($model){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Пользователь создал перевод для CMS",
        "model" => get_class($model),
        "id_record" => $model->id,
        "action" => "created"
    ));
});

Event::listen("translate.update_phrase", function($model){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Пользователь изменил перевод для CMS",
        "model" => get_class($model),
        "id_record" => $model->id,
        "action" => "update"
    ));
});

Event::listen("translate.delete", function($model){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Пользователь удалил перевод для CMS",
        "model" => get_class($model),
        "id_record" => $model->id,
        "action" => "delete"
    ));
});
