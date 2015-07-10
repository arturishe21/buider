<?php

class News extends BaseModel
{

    protected $table = 'news';

    public function getDate()
    {
        return  date("d",strtotime($this->created_at))." ".Util::getMonth($this->created_at);
    } // end getCreatedDate

}