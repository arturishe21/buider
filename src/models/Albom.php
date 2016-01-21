<?php namespace Vis\Builder;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Albom extends \Baum\Node {

    protected $table = 'albums';
    protected $fillable = array('title');


}