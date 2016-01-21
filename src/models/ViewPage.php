<?php namespace Vis\Builder;

use Illuminate\Database\Eloquent\Model;

class ViewPage extends Model {

    protected $table = 'views_page';
    protected $fillable = array('model', 'id_record', 'created_at');

    public function setUpdatedAt($value) {
        // Do nothing.
    }
}