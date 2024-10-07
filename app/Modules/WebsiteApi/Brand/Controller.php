<?php

namespace App\Modules\WebsiteApi\Brand;

use App\Http\Controllers\Controller as ControllersController;




use App\Modules\WebsiteApi\Brand\Actions\GetAllbrand;
use App\Modules\WebsiteApi\Brand\Actions\GetAllFeaturedBrand;


class Controller extends ControllersController
{

    public function GetAllBrand()
    {
        $data = GetAllBrand::execute();
        return $data;
    }
    public function GetAllFeaturedBrand()
    {

        $data = GetAllFeaturedBrand::execute();
        return $data;
    }

}
