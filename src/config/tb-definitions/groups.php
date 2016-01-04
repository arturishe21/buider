<?php

return array(
    'db' => array(
        'table' => 'groups',
        'order' => array(
            'id' => 'ASC',
        ),
        'pagination' => array(
            'per_page' => 20,
            'uri' => '/admin/handle/groups',
        ),
    ),
    'options' => array(
        'caption' => __cms('Группы пользователей'),
        'ident' => 'groups-container',
        'form_ident' => 'groups-form',
        'table_ident' => 'groups-table',
        'action_url' => '/admin/handle/groups',
        'not_found'  => 'NOT FOUND',
        'model' => 'Vis\Builder\Group',
    ),

    'fields' => array(
        'id' => array(
            'caption' => '#',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
            'is_sorting' => false,
        ),
        'title' => array(
            'caption' => __cms('Имя'),
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
        ),
        'name' => array(
            'caption' => __cms('Название'),
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => false,
        ),
    ),

    'actions' => array(
        'search' => array(
            'caption' => __cms("Поиск"),
        ),
        'insert' => array(
            'caption' => __cms("Добавить"),
        ),
        'update' => array(
            'caption' => 'Редактировать',
            'check' => function() {
                return true;
            }
        ),
        'delete' => array(
            'caption' => __cms("Удалить"),
        ),
    ),
);