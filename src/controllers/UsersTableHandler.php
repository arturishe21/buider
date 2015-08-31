<?php
namespace Vis\Builder;

use Illuminate\Support\Facades\URL;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Config;

class UsersTableHandler extends \Vis\Builder\Handlers\CustomHandler
{
    public function handleDeleteRow($id)
    {
        $user = Sentry::findUserById($id);
        $user->delete();

        return array(
            'id'     => $id,
            'status' => true
        );
    } // end handleDeleteRow

    public function onInsertButtonFetch($def)
    {
        $url = URL::to(Config::get('builder::admin.uri') . '/tb/users/create');
        $caption = isset($def['caption']) ? $def['caption'] : 'Add';
        $html = '<a href="'. $url .'">
                <button class="btn btn-default btn-sm btn-success" style="min-width: 66px;"
                         type="button">
                     '. __cms($caption) .'
                 </button>
                 </a>';

        return $html;
    } // end onInsertButtonFetch

    /*
    public function onUpdateRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_update',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
    } // end onUpdateRowResponse

    public function onInsertRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_insert',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
    } // end onInsertRowResponse

    public function onDeleteRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_delete',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
    } // end onDeleteRowResponse
    */
}