<?php

return array(
    'db' => array(
        'table' => 'news',
        'order' => array(
            'priority' => 'asc',
        ),
        'pagination' => array(
            'per_page' => 20,
            'uri' => '/admin/news',
        ),
    ),
    'options' => array(
        'caption' => 'Новости',
        'ident' => 'news',
        'form_ident' => 'news-form',
        'form_width' => '920px',
        'table_ident' => 'news-table',
        'action_url' => '/admin/handle/news',
        'not_found' => 'пусто',
        'is_sortable' => true,
        'model' => 'News',
    ),
    'position' => array(
        'tabs' => array(
            'Общая'     => array(
                'id',
                'title',
                'description',
                'created_at',
                'updated_at',
                'is_active',
            ),

            'SEO'    => array(
                'seo_title',
                'seo_description',
                'seo_keywords',
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
            'is_sorting' => true
        ),
        'title' => array(
            'caption' => 'Название',
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
            'field' => 'string',

            'tabs' => array(

                array(
                    'caption' => 'ru',
                    'postfix' => '',
                    'placeholder' => 'Текст на русском'
                ),
                array(
                    'caption' => 'ua',
                    'postfix' => '_ua',
                    'placeholder' => 'Текст на украинском'
                ),
                array(
                    'caption' => 'en',
                    'postfix' => '_en',
                    'placeholder' => 'Текст на английском'
                ),
            )
        ),
/*
        'id_catalog' => array(
            'caption' => 'Каталог',
            'type'    => 'foreign',
            'filter'  => 'text',
            'is_null' => false,
            'is_readonly'  => false,
            'alias'        => 'c',
            'foreign_table'       => 'tb_tree',
            'foreign_key_field'   => 'id',
            'foreign_value_field' => 'title',
            'additional_where' => array(
                'tb_tree.parent_id' => array(
                    'sign' => '=',
                    'value' => 6
                )
            )
        ),*/

        'description' => array(
            'caption' => 'Текст',
            'type'    => 'wysiwyg',
            'wysiwyg' => 'redactor',
            'editor-options' => array(
                'lang' => 'ru-RU',
            ),
            'hide_list' => true,
            'field' => 'text',
            'tabs' => array(

                array(
                    'caption' => 'ru',
                    'postfix' => '',
                    'placeholder' => 'Текст на русском'
                ),
                array(
                    'caption' => 'ua',
                    'postfix' => '_ua',
                    'placeholder' => 'Текст на украинском'
                ),
                array(
                    'caption' => 'en',
                    'postfix' => '_en',
                    'placeholder' => 'Текст на английском'
                ),
            )
        ),

        'created_at' => array(
            'caption' => 'Дата создания',
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
        'is_active' => array(
            'caption' => 'Статья активна',
            'type' => 'checkbox',
            'options' => array(
                1 => 'Активные',
                0 => 'He aктивные',
            ),
            'field' => 'tinyInteger',
        ),

        'seo_title' => array(
            'caption' => 'Seo: title',
            'type' => 'text',
            'filter' => 'text',
            'hide_list' => true,
            'field' => 'string',
        ),
        'seo_description' => array(
            'caption' => 'Seo: description',
            'type' => 'text',
            'filter' => 'text',
            'hide_list' => true,
            'field' => 'text',
        ),
        'seo_keywords' => array(
            'caption' => 'Seo: keywords',
            'type' => 'text',
            'filter' => 'text',
            'hide_list' => true,
            'field' => 'string',
        ),
    ),
    'filters' => array(
    ),
    'actions' => array(
        /* 'search' => array(
             'caption' => 'Поиск',
         ),*/
        'insert' => array(
            'caption' => 'Добавить',
            'check' => function() {
                return true;
            }
        ),
        'preview' => array(
            'caption' => 'Предпросмотр',
            'check' => function() {
                return true;
            }
        ),
        'clone' => array(
            'caption' => 'Клонировать',
            'check' => function() {
                return true;
            }
        ),
        'update' => array(
            'caption' => 'Редактировать',
            'check' => function() {
                return true;
            }
        ),
        'delete' => array(
            'caption' => 'Удалить',
            'check' => function() {
                return true;
            }
        ),
    ),
);