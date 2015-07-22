<?php

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

include 'view_composers.php';

Route::get('/news/{slug}-{id}', array(
        'as' => 'news_article',
        'uses' => 'NewsController@showPageArticle')
);


Route::get('/articles/{slug}-{id}', array(
        'as' => 'articles_article',
        'uses' => 'ArticlesController@showPageArticle')
);
