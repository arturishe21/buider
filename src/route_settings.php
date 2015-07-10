<?php
Route::group(
    array(
        'prefix' => Config::get('builder::admin.uri'),
        'before' => array('auth_admin', 'check_permissions')
    ), function () {

        Route::any(
            '/settings/settings_all', array(
                'as' => 'm.show_settings',
                'uses' => 'App\Modules\Settings\Controllers\SettingsController@fetchIndex'
            )
        );

        if (Request::ajax()) {
            Route::post(
                '/settings/create_pop', array(
                    'as' => 'm.created_settings',
                    'uses' => 'App\Modules\Settings\Controllers\SettingsController@fetchCreate'
                )
            );
            Route::post(
                '/settings/add_record', array(
                    'as' => 'm.add_settings',
                    'uses' => 'App\Modules\Settings\Controllers\SettingsController@doSave'
                )
            );
            Route::post(
                '/settings/delete', array(
                    'as' => 'm.del_settings',
                    'uses' => 'App\Modules\Settings\Controllers\SettingsController@doDeleteSetting'
                )
            );
            Route::post(
                '/settings/edit_record', array(
                    'as' => 'm.edit_settings',
                    'uses' => 'App\Modules\Settings\Controllers\SettingsController@fetchEdit'
                )
            );
            Route::post(
                '/settings/del_select', array(
                    'as' => 'm.del_select_setting',
                    'uses' => 'App\Modules\Settings\Controllers\SettingsController@doDeleteSettingSelect'
                )
            );

        }

    }
);

