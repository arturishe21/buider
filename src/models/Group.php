<?php namespace Vis\Builder;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $table = 'groups';
    protected $fillable = array('name', 'title', 'permissions');

    public $timestamps = false;
}