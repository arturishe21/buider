<?php

class HomeController extends  Vis\Builder\TreeController  {

    public function showPage()
    {
        $page = $this->node;

        return View::make('pages.index', compact("page"));
    } // end showPage

}
