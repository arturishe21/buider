<?php

return array(
    'db' => array(
        'table' => 'users',
            'order' => array(
            'created_at' => 'DESC',
        ),
        'pagination' => array(
            'per_page' => array(
                10 => '10', 
                20 => '20', 
                50 => '50',
                100 => '100',
                9999999 => 'Все'
            ),
            'uri' => '/admin/tb/users',
        ),
    ),
    'options' => array(
        'caption' => 'Пользователи',
        'ident' => 'users-container',
        'form_ident' => 'users-form',
        'table_ident' => 'users-table',
        'action_url' => '/admin/handle/users',
        'handler'    => 'Vis\Builder\UsersTableHandler',
        'not_found'  => 'NOT FOUND',
    ),
    
    'fields' => array(
        'id' => array(
            'caption' => '#',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
        ),
        'email' => array(
            'caption' => 'Email',
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
            'validation' => array(
                'server' => array(
                    'rules' => 'required'
                ),
                'client' => array(
                    'rules' => array(
                        'required' => true
                    ),
                    'messages' => array(
                        'required' => 'Обязательно к заполнению'
                    )
                )
            ),
        ),
        'last_name' => array(
            'caption' => 'Фамилия',
            'type'    => 'text',
            'filter' => 'text',
            'is_sorting' => true,
            'validation' => array(
                'server' => array(
                    'rules' => 'required'
                ),
                'client' => array(
                    'rules' => array(
                        'required' => true
                    ),
                    'messages' => array(
                        'required' => 'Обязательно к заполнению'
                    )
                )
            ),
        ),
        'first_name' => array(
            'caption'   => 'Имя',
            'type'      => 'text',
            'filter'    => 'text',
            'is_sorting' => true,
            'validation' => array(
                'server' => array(
                    'rules' => 'required'
                ),
                'client' => array(
                    'rules' => array(
                        'required' => true
                    ),
                    'messages' => array(
                        'required' => 'Обязательно к заполнению'
                    )
                )
            ),
        ),

        'last_login' => array(
            'caption' => 'Дата последнего входа',
            'type' => 'readonly',
            'hide' => true,
            'is_sorting' => true,
            'months' => 2
        ),
        'created_at' => array(
            'caption' => 'Дата регистрации',
            'type' => 'readonly',
            'hide' => true,
            'is_sorting' => true,
            'months' => 2
        ),
        'updated_at' => array(
            'caption' => 'Дата обновления',
            'type' => 'readonly',
            'hide' => true,
            'is_sorting' => true,
            'months' => 2,
            'hide_list' => true,
        ),
        'activated' => array(
            'caption' => 'Активен',
            'type' => 'checkbox',
            'options' => array(
                1 => 'Активные',
                0 => 'He aктивные',
            ),
        ),
    ),
    
    'actions' => array(
        'search' => array(
            'caption' => 'Поиск',
        ),
        'insert' => array(
            'caption' => 'Добавить',
            'check' => function() {
                return true;
            }
        ),
        'custom' => array(
            array(
                'caption' => 'Редактировать',
                'icon' => 'pencil',
                'link' => '/admin/tb/users/%d',
                'params' => array(
                    'id'
                )
            )
        ),
        'delete' => array(
            'caption' => 'Удалить',
        ),
    ),

);