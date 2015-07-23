<?php

class BaseModel extends Eloquent
{
    use \Vis\Builder\Helpers\Traits\TranslateTrait,
        \Vis\Builder\Helpers\Traits\SeoTrait;

    /*
     * get transliteration slug this page
     * @return string
     */
    public function getSlug()
    {
        return Jarboe::urlify(strip_tags($this->title));
    }

    /*
     * get url this page with location
     * @return string
     */
    public function getUrl()
    {
        return geturl($this->getUri());
    }

    public function getUri()
    {
        return '/news/'. $this->getSlug().'-'. $this->id;
    } // end getUri

    public function getDate()
    {
        return Util::getDateOnly($this->created_at);
    } // end getCreatedDate

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
            foreach ($images as $imgOne) {
                $imagesRes[] = glide($imgOne, $paramImg);
            }

            return $imagesRes;
        }

        return $images;
    }

    /*
     * filter active page
     * @return object query
     */
    public  static function  scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

    /*
     * order query priority asc
     * @return object query
     */
    public  static function  scopeOrderPriority($query)
    {
        return $query->orderBy("priority", "asc");
    }

    /*
     * check correct url and return info about page
     * @param object $query
     * @param string $slug this slug page
     * @param integer $id this id page
     * @return object
     */
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

    /*
     * get node this page
     * @return object Tree
     */
    public function getNode()
    {
        $segments =  $segments = explode('/', Request::path());
        $nodeSlug = "";

        //search last segment not url page
        foreach ($segments as $segment) {
            if($segment != $this->getSlug().'-'. $this->id) {
                $nodeSlug = $segment;
            }
        }

        if (!$nodeSlug) {
            return false;
        } else {
            return Tree::where("slug", "like", $nodeSlug)->first();
        }
    }
}