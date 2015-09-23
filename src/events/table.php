<?php

use Vis\Builder\Event as EventModel;

Event::listen("table.clone", function($model, $id){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Клонирование статьи",
        "model" => $model,
        "id_record" => $id,
        "action" => "clone"
    ));
});

Event::listen("table.delete", function($model, $id){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Удаление статьи",
        "model" => $model,
        "id_record" => $id,
        "action" => "delete"
    ));
});

Event::listen("table.updated", function($model, $id){
    EventModel::create(array(
        "id_user" => Sentry::getUser()->id,
        "ip_user" => Request::getClientIp(true),
        "message" => "Редактирование статьи",
        "model" => $model,
        "id_record" => $id,
        "action" => "updated"
    ));
});
