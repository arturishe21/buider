<?php

return array(
    
    'is_active' => true,
    
    'model' => 'Tree',
    
     // !isset options - tinyint(1)
     // isset options  - set
    'node_active_field' => array(
        'field' => 'is_active',
    ),
    /*
    'node_active_field' => array(
        'field' => 'active',
        'options' => array(
            // set var => caption
            'ru' => 'Рус',
            'en' => 'Eng',
        ),
    ),
    */

    'templates' => array(
        'О нас' => array(
            'type' => 'node', // table | node
            'action' => 'AboutController@redirectFirst',
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
            'action' => 'AboutController@showPages',
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
