<?php

namespace Vis\Builder\Helpers\Traits;

trait SeoTrait
{
    public function getSeoTitle()
    {
        if( isset($this->seo_title) && !empty($this->seo_title)) {
            return $this->t('seo_title');
        } elseif(isset($this->title)) {
            return $this->t('title');
        }

    } // end getSeoTitle

    public function getSeoDescription()
    {
        if( isset($this->seo_description) && !empty($this->seo_description)) {
            return $this->t('seo_description');
        } elseif(isset($this->short_description)) {
            return $this->t('short_description');
        }

    } // end getSeoTitle
}
