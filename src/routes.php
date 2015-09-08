<?php

$all_links = array_column(Config::get('builder::admin.menu'), "link");

foreach (Config::get('builder::admin.menu') as $menu) {
    if (is_array($menu)) {
        foreach($menu as $menuLink) {
            if (is_array($menuLink)) {
                $all_links[] = array_column($menuLink, "link");
            }
        }

    }
}

$all_links = array_flatten($all_links);
$all_links_str = implode("|",$all_links);
$all_links_str = str_replace("/","",$all_links_str);

Route::pattern('page_admin', $all_links_str);


Route::group(array('prefix' => Config::get('builder::admin.uri'), 'before' => array('auth_admin', 'check_permissions')), function() {

    //router for tree site
    Route::any('/tree', 'Vis\Builder\TableAdminController@showTree');
    Route::any('/handle/tree', 'Vis\Builder\TableAdminController@handleTree');

    //router for pages builder
    Route::get('/{page_admin}', 'Vis\Builder\TableAdminController@showPage');
    Route::post('/{page_admin}', 'Vis\Builder\TableAdminController@showPagePost');

    Route::post('/handle/{page_admin}', 'Vis\Builder\TableAdminController@handlePage');

    // docs page
    Route::get('/', 'Vis\Builder\TBController@showDashboard');

    // logout
    Route::get('logout',  array(
            'as' => 'logout',
            'uses' => 'Vis\Builder\LoginController@doLogout')
    );

    Route::any('/tb/users', 'Vis\Builder\TableAdminController@showUsers');
    Route::post('/handle/users', 'Vis\Builder\TableAdminController@handleUsers');
    Route::any('/tb/groups', 'Vis\Builder\TableAdminController@showGroups');
    Route::post('/handle/groups', 'Vis\Builder\TableAdminController@handleGroups');

    Route::get('tb/users/{id}', 'Vis\Builder\TBUsersController@showEditUser')->where('id', '[0-9]+');
    Route::post('tb/users/update', 'Vis\Builder\TBUsersController@doUpdateUser');
    Route::get('tb/users/create', 'Vis\Builder\TBUsersController@showCreateUser');
    Route::post('tb/users/do-create', 'Vis\Builder\TBUsersController@doCreateUser');

    Route::get('tb/groups/{id}', 'Vis\Builder\TBUsersController@showEditGroup')->where('id', '[0-9]+');
    Route::post('tb/groups/update', 'Vis\Builder\TBUsersController@doUpdateGroup');
    Route::get('tb/groups/create', 'Vis\Builder\TBUsersController@showCreateGroup');
    Route::post('tb/groups/do-create', 'Vis\Builder\TBUsersController@doCreateGroup');
    Route::post('tb/users/upload-image', 'Vis\Builder\TBUsersController@doUploadImage');

    //routes for froala editor
    Route::post('upload_image',  array(
            'as' => 'upload_image',
            'uses' => 'Vis\Builder\EditorController@uploadFoto')
    );
    Route::post('upload_file',  array(
            'as' => 'upload_file',
            'uses' => 'Vis\Builder\EditorController@uploadFile')
    );
    Route::get('load_image',  array(
            'as' => 'load_image',
            'uses' => 'Vis\Builder\EditorController@loadImages')
    );
    Route::post('delete_image',  array(
            'as' => 'delete_image',
            'uses' => 'Vis\Builder\EditorController@deleteImages')
    );

    Route::post('quick_edit',  array(
            'as' => 'quick_edit',
            'uses' => 'Vis\Builder\EditorController@doQuickEdit')
    );




    //change skin for admin panel
    Route::post('change_skin', array(
            'as' => 'change_skin',
            'uses' => 'Vis\Builder\TBController@doChangeSkin')
    );

    Route::get('change_lang',  array(
            'as' => 'change_lang',
            'uses' => 'Vis\Builder\TBController@doChangeLangAdmin')
    );

});

// login post
Route::post('login',  array(
        'before'=>'csrf',
        'as' => 'login',
        'uses' => 'Vis\Builder\LoginController@postLogin')
);

//login show
Route::get('login',  array(
        'as' => 'login_show',
        'uses' => 'Vis\Builder\LoginController@showLogin')
);

//routers for tree site
include 'route_tree.php';

//routers for translation cms
include 'route_translation.php';

//routers for settings
include 'route_settings.php';

//default 404 error
App::missing(function ($exception) {
    return Response::view('admin::errors.404', array(), 404);
});
