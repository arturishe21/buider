<?php

class BaseModel extends Eloquent
{
    use \Vis\Builder\Helpers\Traits\ImageTrait,
        \Vis\Builder\Helpers\Traits\TranslateTrait,
        \Vis\Builder\Helpers\Traits\SeoTrait;

    public function getSlug()
    {
        return Jarboe::urlify(strip_tags($this->title));
    } // end getSlug

    public function getUrl()
    {
        return geturl('/news/'. $this->getSlug() .'-'. $this->id);
    } // end getUrl

    public function getDate()
    {
        return Util::getDateOnly($this->created_at);
    } // end getCreatedDate

    //get main picture
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

    public  function getOtherImg()
    {
        $images = $this->getImages($field = 'dop_pictures');

        $img_result = [];
        foreach ($images as $img) {
            if ($img['sizes']["original"]) {
                $img_result[] = $img['sizes']["original"];
            }
        }

        return $img_result;
    }


    public  static function  scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

    public  static function  scopeOrderPriority($query)
    {
        return $query->orderBy("priority", "asc");
    }


    public  function scopePageInfo($query, $slug, $id)
    {

        $page = $query->where("id", $id)->active()->first();

        if (!isset($page->id) || $page->getSlug() != $slug) {
            App::abort(404);
        }
        return $page;
    }


    /*
    * next page
    */
    public function getNextPage()
    {
        $next_page = self::where("is_active", "1")
            ->where("priority", '>', $this->priority)->where("id", "!=", $this->id)
            ->orderBy("priority","asc")
            ->orderBy("id", "desc")
            ->first();


        if (!$next_page) {
            $next_page = self::where("is_active", "1")
                ->where("id", "!=", $this->id)
                ->orderBy("priority","asc")
                ->orderBy("id", "asc")
                ->first();
        }

        return $next_page->getUri();
    } //end next_page

    /*
     * prev page
     */
    public function getPrevPage()
    {
        $prev_page = self::where("is_active", "1")
            ->where("priority", '<', $this->priority)->where("id", "!=", $this->id)
            ->orderBy("priority", "desc")
            ->orderBy("id", "desc")->first();

        if (!$prev_page) {
            $prev_page = self::where("is_active", "1")
                ->where("id", "!=", $this->id)
                ->orderBy("priority","desc")
                ->orderBy("id", "desc")
                ->first();
        }

        return $prev_page->getUri();
    }//end prev_page


}