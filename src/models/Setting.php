<?php

namespace App\Modules\Settings\Models;

use Eloquent, Str , Config, Cache, Input, Validator, Response;
use Illuminate\Support\Facades\Event;


class Setting extends Eloquent {

    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $fillable = array('type', 'title', 'slug', 'value', 'group_type');

    protected $table = 'settings';

    //Некоторые правила валидиции
    public static  $rules = array(
        'title' => 'required',
        'slug' => 'required|max:256|unique:settings,slug,'
    );

    public $timestamps = false;

    /*
     * Возвращает значения настройки
     */
    public static function get($slug)
    {
        if ($slug) {
            $setting_cache = Cache::section('settings')->get($slug);
            if ($setting_cache) {
                return $setting_cache;
            } else {
                $res_setting = Setting::where("slug",'like',$slug)->first();;

                if(!isset($res_setting->type)) {
                    return;
                }

                if ($res_setting->type==2 || $res_setting->type==3 || $res_setting->type==5) {
                    $select = $res_setting->selectValues();
                    Cache::section('settings')->forever($slug, $select);

                    return $select;
                } elseif(isset($res_setting->value)) {
                    Cache::section('settings')->forever($slug, $res_setting->value);

                    return $res_setting->value;
                }
            }
        }
    }  // end get


    public static function getItem($ids){

        if(!$ids){
            return [];
        }

        return SettingSelect::find($ids);
    } //end getItem


    public static function doSaveSetting($data, $file)
    {
        if ($data['id'] == 0) {
            $settings = new Setting;
        } else {
            $settings = Setting::find($data['id']);
        }

        $settings->title = $data['title'];
        $settings->slug = $data['slug'];
        $settings->type = $data['type'];
        $settings->group_type = $data['group'];

        if ($data['type'] < 2 || $data['type']==6) {
            $settings -> value = $data['value'.$data['type']];
        }

        //yes/no
        if ($data['type']==7) {
            $settings -> value =  $data['status'];
        }

        //если тип файл
        if ($data['type'] == 4 && $file) {
            $destinationPath = "storage/settings";
            $ext = $file -> getClientOriginalExtension();
            $hashname = md5(time()) . '.' . $ext;
            $full_path_img = "/" . $destinationPath . '/' . $hashname;
            $upload_success = $file -> move($destinationPath, $hashname);
            $settings->value = $full_path_img;
        }

        $settings->save();

        //если тип список
        if ($data['type'] == 2) {
            $i = 0;
            foreach ($data['select'] as $k => $el) {
                $i++;
                if ($el) {
                    if (is_numeric($k)) {
                        $el = trim($el);
                        if ($el) {
                            $SettingSelect = SettingSelect::find($k);
                            $SettingSelect->id_setting = $settings->id;
                            $SettingSelect->value = $el;
                            $SettingSelect->priority = $i;
                            $SettingSelect->save();
                        }
                    } else {
                        foreach ($data['select']['new'] as $el_new) {
                            $el_new = trim($el_new);
                            if ($el_new) {
                                $SettingSelect = new SettingSelect ;
                                $SettingSelect->id_setting = $settings->id;
                                $SettingSelect->value = $el_new;
                                $SettingSelect->priority = $i;
                                $SettingSelect->save();
                                $i++;
                            }
                        }
                    }

                }
            }
        }

        //если тип двойной список
        if ($data['type'] == 3) {
            $i = 0;
            foreach ($data['select21'] as $k => $el) {
                $i++;
                if ($el) {
                    if (is_numeric($k)) {
                        $el = trim($el);
                        if ($el) {
                            $SettingSelect = SettingSelect::find($k);
                            $SettingSelect->id_setting = $settings->id;
                            $SettingSelect->value = $el;
                            $SettingSelect->value2 = $data['select22'][$k];
                            $SettingSelect->priority = $i;
                            $SettingSelect->save();
                        }
                    }else{
                        foreach ($data['select21']['new'] as $k_new => $el_new) {
                            $el_new = trim($el_new);
                            if ($el_new) {
                                $SettingSelect = new SettingSelect ;
                                $SettingSelect->id_setting = $settings->id;
                                $SettingSelect->value = $el_new;
                                $SettingSelect->value2 = $data['select22']['new'][$k_new];
                                $SettingSelect->priority = $i;
                                $SettingSelect->save();
                                $i++;
                            }

                        }
                    }

                }
            }
        }

        //если тройной список
        if ($data['type'] == 5) {
            $i = 0;
            foreach ($data['select31'] as $k=>$el) {
                $i++;
                if ($el) {
                    if (is_numeric($k)) {
                        $el = trim($el);
                        if ($el) {
                            $SettingSelect = SettingSelect::find($k);
                            $SettingSelect->id_setting = $settings->id;
                            $SettingSelect->value = $el;
                            $SettingSelect->value2 = $data['select32'][$k];
                            $SettingSelect->value3 = $data['select33'][$k];
                            $SettingSelect->priority = $i;
                            $SettingSelect->save();
                        }
                    }else{
                        foreach ($data['select31']['new'] as $k_new => $el_new) {
                            $el_new = trim($el_new);
                            if ($el_new) {
                                $SettingSelect = new SettingSelect ;
                                $SettingSelect->id_setting = $settings->id;
                                $SettingSelect->value = $el_new;
                                $SettingSelect->value2 = $data['select32']['new'][$k_new];
                                $SettingSelect->value3 = $data['select33']['new'][$k_new];
                                $SettingSelect->priority = $i;
                                $SettingSelect->save();
                                $i++;
                            }

                        }
                    }

                }
            }
        }

        Setting::reCacheSettings();

        if ($data['id'] == 0) {
            Event::fire("setting.created", array($settings));
        } else {
            Event::fire("setting.changed", array($settings));
        }

        return $settings;
    }

    /*
    * перезапись кеша c настройками
    */
    public static function reCacheSettings()
    {
        Cache::section('settings')->flush();
    } // end reCacheSettings

    /*
     * Удаление настройки
     */
    public static function doDelete($id)
    {
        if (is_numeric($id)) {
            $id_page = Input::get("id");
            $page = Setting::find($id_page);

            Event::fire("setting.delete", array($page));

            $page->delete();



            Setting::reCacheSettings();
        }
    } // end doDelete


    /*
     * Валидация
     */
    public static function isValid($data, $id)
    {
        Setting::$rules['slug'] .= $id;

        $validator = Validator::make($data, Setting::$rules);
        if ($validator->fails()) {
            return Response::json(
                array(
                    'status' => 'error',
                    "errors_messages" => $validator->messages()
                )
            );
        } else {
            return false;
        }
    }//end isValid


    /*
     * Связзь с SettingSelect
     */
    public function selectValues()
    {
        return $this->hasMany('App\Modules\Settings\Models\SettingSelect', 'id_setting')->orderBy("priority")->get()->toArray();
    } // end select_get


}