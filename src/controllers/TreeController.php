<?php 

namespace Vis\Builder;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;

class TreeController extends \Controller
{
    protected $node;

    public function init($node, $method)
    {
        // FIXME: move paramter to config
        if (!$node->isActive(App::getLocale()) && !Input::has('show')) {
            App::abort(404);
        }
        $this->node = $node;

        return $this->$method();
    } // end init

}