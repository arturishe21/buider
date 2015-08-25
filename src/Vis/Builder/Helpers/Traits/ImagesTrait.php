<?php

namespace Vis\Builder\Helpers\Traits;

use App\Modules\Settings\Models\Setting;

trait ImagesTrait
{
    /*
    *  get main picture this page
    * @param  string|integer $width
    * @param  string|integer $height
    * @return string tag img
    */
    public  function getImg($width = '', $height = '', $options = array())
    {
        if ($this->picture) {
            $picture = $this->picture;
        } else {
            $picture = Setting::get("net-foto");
        }

        $size = [];
        if ($width) {
            $size['w'] = $width;
        }

        if ($height) {
            $size['h'] = $height;
        }

        $params = array_merge($size, $options) ;
        $img_res = glide($picture, $params);

        return  '<img src = "'.$img_res.'" title = "'.$this->title.'" alt = "'.$this->title.'">';
    } // end getImg

    /*
     * get additional pictures this page
     * @param string $nameField field in bd
     * @param array $paramImg param width,height,fit
     * @return array list small images
     */
    public  function getOtherImg($nameField = "additional_pictures", $paramImg = "")
    {
        if (!$this->$nameField) {
            return;
        }

        $images = json_decode($this->$nameField);

        $imagesRes = [];
        foreach ($images as $imgOne) {
            if ($paramImg) {
                $imagesRes[] = glide($imgOne, $paramImg);
            } else {
                $imagesRes[] = "/".$imgOne;
            }

        }

        return $imagesRes;
    }
}
