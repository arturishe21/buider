<?php

namespace Vis\Builder;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Vis\Builder\Facades\Jarboe as JarboeBuilder;

class Tree extends \Baum\Node
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $fillable = [];
    protected $revisionFormattedFieldNames = array(
        'title'  => 'Название',
        'description'  => 'Описание',
        'is_active' => 'Активация',
        'picture' => 'Изображение',
        'short_description' => 'Короткий текст',
        'created_at' => 'Дата создания'
    );
    protected $revisionFormattedFields = array(
        '1'  => 'string:<strong>%s</strong>',
        'public' => 'boolean:No|Yes',
        'deleted_at' => 'isEmpty:Active|Deleted'
    );

    protected $revisionCleanup = true;
    protected $historyLimit = 500;

    protected $fileDefinition = "tree";

    public function getFillable()
    {
        return $this->fillable;
    }

    public function setFillable(array $params)
    {
        $this->fillable = $params;
    }


    protected $table = 'tb_tree';
    protected $parentColumn = 'parent_id';
    protected $_nodeUrl;


    public static function flushCache()
    {
        Cache::tags('j_tree')->flush();
    } // end flushCache
    
    public function setSlugAttribute($value)
    {
        $slug = JarboeBuilder::urlify($value);
        
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

        $tags = $this->getCacheTags();
        if ($tags) {

            $url = Cache::tags($tags)->rememberForever("tree_".$this->id, function() {
               return $this->getGeneratedUrlInCache();
            });

            return $url;

        } else {
            $this->getGeneratedUrlInCache();
        }

    } // end getGeneratedUrl

    private function getGeneratedUrlInCache()
    {
        $all = $this->getAncestorsAndSelf();

        $slugs = array();
        foreach ($all as $node) {
            if ($node->slug == '/') {
                continue;
            }
            $slugs[] = $node->slug;
        }

        return implode('/', $slugs);
    }

    public function isHasChilder()
    {
        $tags = $this->getCacheTags();
        if ($tags) {
            return $this->children()->cacheTags($tags)->rememberForever()->count();
        }

        return $this->children()->count();
    }

    public function clearCache()
    {
        $tags = $this->getCacheTags();
        if ($tags) {
            Cache::tags($tags)->flush();
        }
    }

    private function getCacheTags()
    {
        if ($this->fileDefinition) {
            $tags = Config::get("builder::" . $this->fileDefinition . ".cache");
            if (isset($tags['tags']) && is_array($tags['tags'])) {
                return $tags['tags'];
            }
        }

        return false;
    }

}