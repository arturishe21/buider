<?php

return array(
    'db' => array(
        'table' => 'events',
        'order' => array(
            'priority' => 'asc',
        ),
        'pagination' => array(
            'per_page' => 20,
            'uri' => '/admin/events',
        ),
    ),
    'options' => array(
        'caption' => 'Логирование',
        'ident' => 'events',
        'form_ident' => 'events-form',
        'form_width' => '920px',
        'table_ident' => 'events-table',
        'action_url' => '/admin/handle/events',
        'not_found' => 'пусто',
        'is_sortable' => false,
        'model' => 'Vis\Builder\Event',
    ),
    'position' => array(
        'tabs' => array(
            'Общая'     => array(
                'id',
                'id_user',
                'ip_user',
                'message',
                'model',
                'id_record',
                'action',
                'created_at',
                'updated_at',
            ),
        )
    ),
    'fields' => array(
        'id' => array(
            'caption' => '#',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
            'is_sorting' => true,
        ),
        'id_user' => array(
            'caption' => 'ID пользователя',
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
            'field' => 'string'
        ),
        'ip_user' => array(
            'caption' => 'IP пользователя',
            'type'    => 'text',
            'filter' => 'text',
            'is_sorting' => true,
        ),
        'message' => array(
            'caption' => 'Сообщение',
            'type'    => 'text',
            'filter' => 'text',
            'is_sorting' => true,
        ),
        'model' => array(
            'caption' => 'Модель/таблица',
            'type'    => 'text',
            'filter' => 'text',
            'is_sorting' => true,
        ),
        'id_record' => array(
            'caption' => 'Id записи',
            'type'    => 'text',
            'filter' => 'text',
            'is_sorting' => true,
        ),
        'action' => array(
            'caption' => 'Действие',
            'type'    => 'text',
            'filter' => 'text',
            'is_sorting' => true,
        ),

        'created_at' => array(
            'caption' => 'Дата/Время',
            'type' => 'datetime',
            'is_sorting' => true,
            'months' => 2,
            'field' => 'timestamp',
        ),
        'updated_at' => array(
            'caption' => 'Дата обновления',
            'type' => 'readonly',
            'hide_list' => true,
            'is_sorting' => true,
            'hide'        => true,
            'field' => 'timestamp',
        ),

    ),
    'filters' => array(
    ),
    'actions' => array(
    ),
);