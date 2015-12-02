<?php

return array(
    'db' => array(
        'table' => 'tb_tree',
        'order' => array(
            'id' => 'ASC',
        ),
        'pagination' => array(
            'per_page' => 1,
            'uri' => '/admin/tree',
        ),
    ),
    'options' => array(
        'caption' => '',
        'ident' => 'settings-container',
        'form_ident' => 'about-form',
        'form_width' => '920px',
        'table_ident' => 'about-table',
        'action_url' => '/admin/tree?node='. $options['node'],
        'not_found' => 'NOT FOUND',
        'model' => 'Tree',
    ),
    'position' => array(
        'tabs' => array(
            'Общая'     => array(
                'id',
                'title',
                'slug',
                'description',
                'show_in_menu',
                'show_in_footer_menu',
                'created_at',
                'updated_at',
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
            'caption' => 'Title',
            'type' => 'text',
            /* 'tabs' => array(

                 array(
                     'caption' => 'ru',
                     'postfix' => '',
                     'placeholder' => 'Название на русском'
                 ),
                 array(
                     'caption' => 'ua',
                     'postfix' => '_ua',
                     'placeholder' => 'Название на украинском'
                 ),
                 array(
                     'caption' => 'en',
                     'postfix' => '_en',
                     'placeholder' => 'Название на английском'
                 ),
             )*/
        ),
        'description' => array(
            'caption' => 'Текст',
            'type'    => 'wysiwyg',
            'wysiwyg' => 'redactor',
            'editor-options' => array(
                'lang' => 'ru-RU',
            ),
            /* 'tabs' => array(

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
             )*/
        ),
        'created_at' => array(
            'caption' => 'Дата создания',
            'type' => 'datetime',
            'hide' => true,
        ),
        'updated_at' => array(
            'caption' => 'Дата обновления',
            'type' => 'datetime',
            'hide' => true,
        ),
        'show_in_menu' => array(
            'caption' => 'Показывать в меню',
            'type' => 'checkbox',
            'options' => array(
                1 => 'Да',
                0 => 'Нет',
            ),
            'field' => 'tinyInteger',
        ),
        'show_in_footer_menu' => array(
            'caption' => 'Показывать в футере меню ',
            'type' => 'checkbox',
            'options' => array(
                1 => 'Да',
                0 => 'Нет',
            ),
            'field' => 'tinyInteger',
        ),

        'seo_title' => array(
            'caption' => 'SEO title',
            'type' => 'text',
        ),

        'seo_description' => array(
            'caption' => 'SEO description',
            'type' => 'textarea',
            'rows' => '2',
        ),

        'seo_keywords' => array(
            'caption' => 'SEO keywords',
            'type' => 'text',
        ),

        'slug' => array(
            'caption' => 'Url',
            'type' => 'text'
        ),

    ),

    'filters' => array(
    ),

    'actions' => array(
        'search' => array(
            'caption' => 'Search',
        ),
        'insert' => array(
            'caption' => 'Create',
            'check' => function() {
                return true;
            }
        ),
        'update' => array(
            'caption' => 'Update',
            'check' => function() {
                return true;
            }
        ),
        'delete' => array(
            'caption' => 'Remove',
            'check' => function() {
                return true;
            }
        ),
    ),
);