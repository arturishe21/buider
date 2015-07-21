<?php

namespace Vis\Builder;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Tree extends \Baum\Node 
{
    protected $table = 'tb_tree';
    protected $parentColumn = 'parent_id';

    protected $_nodeUrl;
    
    public static function flushCache()
    {
        Cache::tags('j_tree')->flush();
    } // end flushCache
    
    public function setSlugAttribute($value)
    {
        $slug = Jarboe::urlify($value);
        
        $slugs = $this->where('parent_id', $this->parent_id)
                      ->where('id', '<>', $this->id)
                      ->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")
                      ->lists('slug');
        
        $slugCount = '';
        if ($slugs) {
            $slugCount = 0;
            
            foreach ($slugs as $existedSlug) {
                preg_match('~(\d+)$~', $existedSlug, $matches);
                if (isset($matches[1])) {
                    $slugCount = $slugCount > $matches[1] ? $slugCount : $matches[1];
                }
            }

            $slugCount++;
        }
        
        $slug = $slugCount ? $slug .'-'. $slugCount : $slug;
        
        $this->attributes['slug'] = $slug;
    } // end setSlugAttribute

    public function hasTableDefinition()
    {
        $templates = Config::get('builder::tree.templates');
        $template = Config::get('builder::tree.default');
        if (isset($templates[$this->template])) {
            $template = $templates[$this->template];
        }

        return $template['type'] == 'table';
    } // end hasTableDefinition

    public function setUrl($url)
    {
        $this->_nodeUrl = $url;
    } // end setUrl

    public function getUrl()
    {
        if (!$this->_nodeUrl) {
            $this->_nodeUrl = $this->getGeneratedUrl();
        }
        return "/".$this->_nodeUrl;
    } // end getUrl

    //return url without location
    public function getUrlNoLocation(){

        if (!$this->_nodeUrl) {
            $this->_nodeUrl = $this->getGeneratedUrl();
        }
        return "/".$this->_nodeUrl;
    }

    public function isActive($setIdent = false)
    {
        $activeField = Config::get('builder::tree.node_active_field.field');
        $options = Config::get('builder::tree.node_active_field.options', array());
        
        if (!$options) {
            return $this->$activeField == 1;
        }
        if ($setIdent) {
            return !!preg_match('~'. preg_quote($setIdent) .'~', $this->$activeField);
        }

        foreach ($options as $ident => $caption) {
            if (preg_match('~'. preg_quote($ident) .'~', $this->$activeField)) {
                return true;
            }
        }
        
        return false;
    } // end isActive

    public function getGeneratedUrl()
    {
        $all = $this->getAncestorsAndSelf();

        $slugs = array();
        foreach ($all as $node) {
            if ($node->slug == '/') {
                continue;
            }
            $slugs[] = $node->slug;
        }

      //  exit(implode('/', $slugs));

        return implode('/', $slugs);
    } // end getGeneratedUrl

}