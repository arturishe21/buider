<?php

namespace Vis\Builder\Helpers\TableHandlers;

use Vis\Builder\Handlers\CustomHandler as CustomHandler;


class Slug extends CustomHandler 
{
            
    public function onUpdateRowResponse(array &$response)
    {
        
        if (isset($response['values']['slug'])) {
            $model = '\\'. \Config::get('builder::tree.model');
            
            $entity = $model::find($response['id']);
            $entity->slug = $response['values']['slug'];
            $entity->save();
        }
    } // end onUpdateRowResponse
    
}