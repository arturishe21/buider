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
    public  function getImg($width = '', $height = '')
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

        $size['fit'] = "crop";
        $img_res = glide($picture, $size);

        return  '<img src = "'.$img_res.'" title = "'.$this->title.'" alt = "'.$this->title.'">';
    } // end getImg

    /*
     * get additional pictures this page
     * @param string $nameField field in bd
     * @param array $paramImg param width,height,fit
     * @return array list small images
     */
    public  function getOtherImg($nameField = "additional_pictures", array $paramImg)
    {
        if (!$this->$nameField) {
            return;
        }

        $images = json_decode($this->$nameField);

        if ($paramImg) {
            $imagesRes = [];
            foreach ($images as $imgOne) {
                $imagesRes[] = glide($imgOne, $paramImg);
            }

            return $imagesRes;
        }

        return $images;
    }
}
