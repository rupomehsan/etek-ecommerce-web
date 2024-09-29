<?php

namespace App\Modules\WebsiteApi\SearchHandling;

use App\Modules\WebsiteApi\SearchHandling\Actions\HomePageGlobalSearch;

use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function HomePageGlobalSearch()
    {
        $data = HomePageGlobalSearch::execute();
        return $data;
    }



}
