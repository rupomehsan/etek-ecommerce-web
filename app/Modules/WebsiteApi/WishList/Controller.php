<?php

namespace App\Modules\WebsiteApi\WishList;

use App\Modules\WebsiteApi\WishList\Actions\All;
use App\Modules\WebsiteApi\WishList\Actions\Destroy;
use App\Modules\WebsiteApi\WishList\Actions\Store;

use App\Modules\WebsiteApi\WishList\Validations\GetAllValidation;

use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index(GetAllValidation $request)
    {
        $data = All::execute($request);
        return $data;
    }

    public function store()
    {
        $data = Store::execute();
        return $data;
    }




    public function destroy($id)
    {
        $data = Destroy::execute($id);
        return $data;
    }


}
