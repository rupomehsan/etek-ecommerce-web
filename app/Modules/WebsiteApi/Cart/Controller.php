<?php

namespace App\Modules\WebsiteApi\Cart;

use App\Modules\WebsiteApi\Cart\Actions\All;
use App\Modules\WebsiteApi\Cart\Actions\Destroy;
use App\Modules\WebsiteApi\Cart\Actions\Store;
use App\Modules\WebsiteApi\Cart\Actions\Update;

use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index()
    {
        $data = All::execute();
        return $data;
    }

    public function store()
    {
        $data = Store::execute();
        return $data;
    }



    public function update()
    {
        $data = Update::execute();
        return $data;
    }


    public function destroy($cartId)
    {
        $data = Destroy::execute($cartId);
        return $data;
    }


}
