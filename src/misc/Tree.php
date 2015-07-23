<?php

class Tree extends Vis\Builder\Tree
{
    use \Vis\Builder\Helpers\Traits\TranslateTrait,
        \Vis\Builder\Helpers\Traits\SeoTrait;

    public static function getFirstDepthNodes()
    {
        return Tree::where('depth', '1')->get();
    } // end getFirstDepthNodes

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    } // end scopeActive

    public function scopeIsMenu($query)
    {
        return $query->where("show_in_menu", 1)->where('is_active', '1')->orderBy('lft', 'asc');
    } // end scopeActive

    public function scopePriorityAsc($query)
    {
        return $query->orderBy('lft', 'asc');
    } // end scopeMain

    public function getDate()
    {
        return Util::getDate($this->created_at);
    } // end getDate

    //url page
    public function getUrl()
    {
        return geturl(parent::getUrl(), App::getLocale());
    }

    public function checkActiveMenu()
    {
        $pathUrl = str_replace(Request::root()."/", "" , $this->getUrl());

        if (Request::is($pathUrl) ||  Request::is($pathUrl."/*")) {
           return true;
        } else {
            return false;
        }
    }

}