<?php namespace Vis\Builder\Helpers;

use Vis\Builder\Handlers\CustomHandler;
use Illuminate\Support\Facades\View;

class OrdersTableHandler extends CustomHandler
{

    public function onGetEditInput($formField, array &$row)
    {
        if ($row) {

            if ($formField->getFieldName() == 'products') {

                $order = \Order::where("id", $row['id'])->first();
                if (isset($order->id)) {
                    $orderProducts = $order->products();

                    return View::make('partials.order_products', compact('orderProducts'));
                }
            }
        }
    } // end onGetEditInput

    public function onAddSelectField($field, $db)
    {
        if ($field->getFieldName() == "products") {
            return true;
        }
    }

}