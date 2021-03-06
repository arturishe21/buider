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
        'caption' => 'О нас',
        'ident' => 'settings-container',
        'form_ident' => 'about-form',
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
            /*    'description',*/
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
            'caption' => 'slug',
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