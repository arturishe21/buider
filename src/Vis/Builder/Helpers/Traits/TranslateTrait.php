<?php
namespace Vis\Builder\Helpers\Traits;

use Illuminate\Support\Facades\App;

trait TranslateTrait
{
    public function translate($ident, $lang = null)
    {
        if (!$lang) {
            $lang = App::getLocale();
        }
        if ($lang == 'ru') {
            $ident .= '';
        } else if ($lang == 'ua') {
            $ident .= '_ua';
        } else {
            $ident .= '_en';
        }

        return $this->$ident;
    } // end translate


    public function t($ident, $lang = null)
    {
        return $this->translate($ident, $lang);
    } // end t
}