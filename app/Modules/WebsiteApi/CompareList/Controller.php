<?php

namespace App\Modules\WebsiteApi\CompareList;

use App\Modules\WebsiteApi\CompareList\Actions\All;
use App\Modules\WebsiteApi\CompareList\Actions\Destroy;
use App\Modules\WebsiteApi\CompareList\Actions\Store;
use App\Modules\WebsiteApi\CompareList\Validations\GetAllValidation;
use App\Modules\WebsiteApi\CompareList\Validations\Validation;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index(GetAllValidation $request)
    {
        $data = All::execute($request);
        return $data;
    }

    public function store(Validation $request)
    {
        $data = Store::execute($request);
        return $data;
    }


    public function destroy($id)
    {
        $data = Destroy::execute($id);
        return $data;
    }


}
