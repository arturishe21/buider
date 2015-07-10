<?php

return array(
    'caption'  => 'Административная часть сайта',
    'logo_url' => asset('packages/vis/builder/img/logo.png'),
    'favicon_url' => asset('packages/vis/builder/img/favicon/favicon.ico'),
    'uri' => '/admin',

    'menu' => array(

       /* array(
            'title' => 'Главная',
            'icon'  => 'home',
            'link'  => '/',
            'check' => function() {
                return true;
            }
        ),*/

        array(
            'title' => 'Структура сайта',
            'icon'  => 'sitemap',
            'link'  => '/tree',
            'check' => function() {
                return true;
            }
        ),
         array(
            'title' => 'Новости',
            'icon'  => 'building',
            'link'  => '/news',
            'check' => function() {
                return true;
            }
        ),
        array(
            'title' => 'Настройки',
            'icon'  => 'cog',
            'submenu' => array(
                array(
                    'title' => "Переменые",
                    'link'  => '/settings/settings_all',
                    'check' => function() {
                        return true;
                    }
                ),
                array(
                    'title' => 'Переводы CMS',
                    'link'  => '/translations_cms/phrases',
                    'check' => function() {
                        return true;
                    }
                ),
            )
        ),

        array(
            'title' => 'Упр. пользователями',
            'icon'  => 'user',
            'submenu' => array(
                array(
                    'title' => "Пользователи",
                    'link'  => '/tb/users',
                    'check' => function() {
                        return true;
                    }
                ),
                array(
                    'title' => "Группы",
                    'link'  => '/tb/groups',
                    'check' => function() {
                        return true;
                    }
                )
            )
        ),
    ),

);
