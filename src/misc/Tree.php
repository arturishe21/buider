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
        return $query->where("id", 22)->children;
    } // end scopeActive

    public function scopeFooterRight($query)
    {
        return $query->where("is_right_part_footer", 1)->where('is_active', '1');
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

}