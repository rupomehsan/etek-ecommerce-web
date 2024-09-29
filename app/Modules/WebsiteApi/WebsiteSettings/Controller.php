<?php

namespace App\Modules\WebsiteApi\WebsiteSettings;

use App\Modules\WebsiteApi\WebsiteSettings\Actions\GetWebsiteSettings;

use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function GetWebsiteSettings()
    {
        $data = GetWebsiteSettings::execute();
        return $data;
    }

}
