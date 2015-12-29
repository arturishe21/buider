<?php

return array(

    'is_active' => true,

    'model' => 'Vis\Builder\Tree',

    // !isset options - tinyint(1)
    // isset options  - set
    'node_active_field' => array(
        'field' => 'is_active',
    ),

    'cache' => array(
        'tags' => array('tree'),
    ),

    'templates' => array(
        'О нас' => array(
            'type' => 'node', // table | node
            'action' => 'AboutController@showPage',
            'definition' => '',
            'node_definition' => 'node',
            'check' => function() {
                return true;
            },
        ),

        'Статья' => array(
            'type' => 'node', // table | node
            'action' => 'ArticleController@redirectFirst',
            'definition' => '',
            'node_definition' => 'node',
            'check' => function() {
                return true;
            },
        ),

        'Новости' => array(
            'type' => 'node', // table | node
            'action' => 'NewsController@showPages',
            'definition' => '',
            'node_definition' => 'node',
            'check' => function() {
                return true;
            },
        ),

        'Продукты' => array(
            'type' => 'node', // table | node
            'action' => 'ProductsController@showPages',
            'definition' => '',
            'node_definition' => 'node',
            'check' => function() {
                return true;
            },
        ),
        'Статьи' => array(
            'type' => 'node', // table | node
            'action' => 'ArticlesController@showPages',
            'definition' => '',
            'node_definition' => 'node',
            'check' => function() {
                return true;
            },
        ),

        'Контакты' => array(
            'type' => 'node', // table | node
            'action' => 'ContactsController@showPage',
            'definition' => '',
            'node_definition' => 'contacts',
            'check' => function() {
                return true;
            },
        ),

        'Главная' => array(
            'type' => 'node',
            'action' => 'HomeController@showPage',
            'definition' => '',
            'node_definition' => 'node',
            'check' => function() {
                return true;
            },
        ),
    ),

    'default' => array(
        'type' => 'node',
        'action' => 'HomeController@showPage',
        'definition' => 'node',
        'node_definition' => 'node',
    ),



);
