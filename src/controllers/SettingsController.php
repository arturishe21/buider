<?php

namespace App\Modules\Settings\Controllers;

use Config, View, Request, Input, Response, Files;
use App\Modules\Settings\Models\Setting;
use App\Modules\Settings\Models\SettingSelect;


class SettingsController extends \BaseController
{
    /*
    * Стартовая страница настроек в админки
    */
    public function fetchIndex()
    {
        $breadcrumb[Config::get('builder::settings.title_page')] = "";

        $allpage = Setting::orderBy('id',"desc");

        //filter group
        if (is_numeric(Input::get("group"))) {
            $allpage = $allpage -> where("group_type",Input::get("group"));
        }

        $allpage = $allpage -> paginate(20);

        $groups = Config::get('builder::settings.groups');

        $view = "settings.settings_all";
        if (Request::ajax()) {
            $view = "settings.part.settings_center";
        }

        return View::make('builder::'.$view)
            ->with('title', Config::get('builder::settings.title_page'))
            ->with('breadcrumb', $breadcrumb)
            ->with("data", $allpage)
            ->with("groups",$groups);
    } // end fetchIndex

    /*
    * Создания настройки
    */
    public function fetchCreate()
    {
        $types = Config::get('builder::settings.type');
        $groups = Config::get('builder::settings.groups');

        return View::make('builder::settings.part.form_settings')
            ->with("type",$types)
            ->with("groups",$groups);
    } // end fetchCreate

    /*
   * Сохранение настройки
   */
    public function doSave()
    {
        $file = Input::file('file');
        parse_str(Input::get('data'), $data);

        $validation = Setting::isValid($data, $data['id']);
        if($validation){
            return $validation;
        }

        Setting::doSaveSetting($data, $file);

        if ($data["id"] != 0 && is_numeric($data["id"])) {
            $ok_messages = "Запись успешно обновлена";
        } else {
            $ok_messages = "Запись успешно добавлена";
        }

        return Response::json(
            array(
                'status'            => 'ok',
                "ok_messages"       => $ok_messages
            )
        );

    }  // end doSave

    /*
    * Удаление настройки
    */
    public function doDeleteSetting()
    {
        Setting::doDelete(Input::get("id"));

        return Response::json(
            array(
                'status' => 'ok'
            )
        );

    }

    /*
    * Редактирование настройки
    */
    public function fetchEdit()
    {
        $id = Input::get("id");
        if (is_numeric($id)) {
            $page = Setting::findOrFail($id);
            $type = Config::get('builder::settings.type');
            $groups = Config::get('builder::settings.groups');

            $select_info = array();
            if ($page->type == 2 || $page->type == 3  || $page->type == 5) {
                $select_info = SettingSelect::where("id_setting",$page->id)
                    -> orderBy("priority")
                    -> get()
                    ->toArray();
            }

            return View::make('builder::settings.part.form_settings')
                ->with('info', $page)
                ->with("type",$type)
                ->with("select_info",$select_info)
                ->with("groups",$groups);
        }
    } // end fetchEdit

    /*
    * Удаление пункта селекта
    */
    public function doDeleteSettingSelect()
    {
        SettingSelect::doDelete(Input::get("id"));

        return Response::json(
            array(
                'status' => 'ok',
                "text" => "Запись успешно удалена"
            )
        );
    } //end doSettingSelectDelete
}