<?php

return array(
    'caption'  => 'Административная часть сайта',
    'logo_url' => asset('packages/vis/builder/img/logo.png'),
    'favicon_url' => asset('packages/vis/builder/img/favicon/favicon.ico'),
    'uri' => '/admin',
    'limitation_of_ip' => array(),
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
            'icon'  => 'list-alt',
            'link'  => '/news',
            'check' => function() {
                return true;
            }
        ),
       /* array(
            'title' => 'Статьи',
            'icon'  => 'building',
            'link'  => '/articles',
            'check' => function() {
                return true;
            }
        ),
        array(
            'title' => 'Слайдер на главной',
            'icon'  => 'columns',
            'link'  => '/slider_main',
            'check' => function() {
                return true;
            }
        ),*/
      /*  array(
            'title' => 'Баннера',
            'icon'  => 'crop',
            'submenu' => array(
                array(
                    'title'   => 'Баннера',
                    'link'    => '/banners/banners_all',
                    'check' => function() {
                        return true;
                    }
                ),
                array(
                    'title' => 'Баннерные площадки',
                    'link'  => '/banners/area',
                    'check' => function() {
                        return true;
                    }
                ),

            ),
        ),*/
        array(
            'title' => 'Настройки',
            'icon'  => 'cog',
            'submenu' => array(
                array(
                    'title' => "Управление",
                    'submenu' => array(
                        array(
                            'title' => 'Общее',
                            'link'  => '/settings/settings_all?group=general',
                            'check' => function() {
                                return true;
                            }
                        ),
                        array(
                            'title' => 'SEO',
                            'link'  => '/settings/settings_all?group=seo',
                            'check' => function() {
                                return true;
                            }
                        ),
                        array(
                            'title' => 'Изображения',
                            'link'  => '/settings/settings_all?group=graphics',
                            'check' => function() {
                                return true;
                            }
                        ),
                        array(
                            'title' => 'Безопасность',
                            'link'  => '/settings/settings_all?group=security',
                            'check' => function() {
                                return true;
                            }
                        ),
                        array(
                            'title' => 'Цены',
                            'link'  => '/settings/settings_all?group=price',
                            'check' => function() {
                                return true;
                            }
                        ),
                    ),
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
                array(
                    'title' => 'Логирование',
                    'link'  => '/events',
                    'check' => function() {
                        return true;
                    }
                ),
                array(
                    'title' => 'Контроль изменений',
                    'link'  => '/revisions',
                    'check' => function() {
                        return true;
                    }
                )
            )
        ),

        array(
            'title' => 'Упр. пользователями',
            'icon'  => 'user',
            'submenu' => array(
                array(
                    'title' => "Пользователи",
                    'link'  => '/users',
                    'check' => function() {
                        return true;
                    }
                ),
                array(
                    'title' => "Группы",
                    'link'  => '/groups',
                    'check' => function() {
                        return true;
                    }
                )
            )
        ),
    ),

);
