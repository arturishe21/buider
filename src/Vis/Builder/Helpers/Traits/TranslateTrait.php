<?php
namespace Vis\Builder\Helpers\Traits;

use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait TranslateTrait
{

    public function t($ident)
    {
        $lang = LaravelLocalization::setLocale();

        if ($lang) {
            $ident = $ident."_".$lang;
        }

        return $this->$ident;
    } // end t
}