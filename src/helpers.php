<?php

if (!function_exists('dr'))
{
    function dr($array)
    {
        echo '<pre>';
        die(print_r($array));
    } // end dr
}

if (!function_exists('print_arr'))
{
    function print_arr($array)
    {
        echo '<pre>';
        print_r($array);
        echo "</pre>";
    } // end dr
}

if (!function_exists('cartesian'))
{
    function cartesian($arr, $isElementsDuplicated = false)
    {
        $variant = array();
        $result  = array();
        $arrayCount = sizeof($arr);

        return cartesianRecurseIt($arr, $variant, -1, $result, $arrayCount, $isElementsDuplicated);
    } // end cartesian
}

if (!function_exists('cartesianRecurseIt'))
{
    function cartesianRecurseIt($arr, $variant, $level, $result, $arrayCount, $isElementsDuplicated)
    {
        $level++;
        if ($level < $arrayCount) {
            foreach ($arr[$level] as $val) {
                $variant[$level] = $val;
                $result = cartesianRecurseIt($arr, $variant, $level, $result, $arrayCount, $isElementsDuplicated);
            }
        } else {
            if (!$isElementsDuplicated) {
                $result[] = $variant;
            } else {
                if (sizeof(array_flip(array_flip($variant))) == $arrayCount) {
                    $result[] = $variant;
                }
            }
        }
        return $result;
    } // end cartesianRecurseIt
}

if (!function_exists('remove_bom'))
{
    function remove_bom($val)
    {
        if (substr($val, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
            $val = substr($val, 3);
        }
        return $val;
    } // end remove_bom
}

if (!function_exists('glide'))
{
    function glide($source, $options = array())
    {
        if (!$source) return;
        
        return asset(GlideImage::load($source)->modify($options));
    } // end glide
}

if (!function_exists('filesize_format'))
{
    function filesize_format($bytes) 
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 1, '.', '') . ' Gb';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 1, '.', '') . ' Mb';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 1, '.', '') . ' Kb';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
    
        return $bytes;
    } // end filesize_format
}

//return localization url
if (!function_exists('geturl'))
{
    function geturl($url, $locale = false, $attributes = array())
    {
        if (!$locale) {
            $locale = App::getLocale();
        }

        return LaravelLocalization::getLocalizedURL($locale, $url, $attributes);
    } // end geturl
}

/*
 * translate phrase cms
 */
if(!function_exists("__cms")) {
    function __cms($phrase)
    {

        $this_lang = Cookie::get("lang_admin");

        //Cache::forget("translations");
        $array_translate = Vis\TranslationsCMS\Trans::fillCacheTrans();

        if (isset($array_translate[$phrase][$this_lang])) {
            return $array_translate[$phrase][$this_lang];
        } else {
            return $phrase;
        }
    }
}

