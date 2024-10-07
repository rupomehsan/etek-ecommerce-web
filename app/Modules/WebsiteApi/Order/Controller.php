<?php

namespace App\Modules\WebsiteApi\Order;


use App\Modules\WebsiteApi\Order\Actions\EcommerceOrder;
use App\Modules\WebsiteApi\Order\Actions\GetAllEcommerceOrder;
use App\Modules\WebsiteApi\Order\Actions\GetSingleOrderDetails;

use App\Modules\WebsiteApi\Order\Validations\Validation;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function EcommerceOrder(Validation $request)
    {
        $data = EcommerceOrder::execute($request);
        return $data;
    }
    public function GetAllEcommerceOrder()
    {
        $data = GetAllEcommerceOrder::execute();
        return $data;
    }
    public function GetSingleOrderDetails($orderId)
    {
        $data = GetSingleOrderDetails::execute($orderId);
        return entityResponse($data);
    }
}
