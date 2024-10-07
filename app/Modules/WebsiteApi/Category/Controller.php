<?php

namespace App\Modules\WebsiteApi\Category;

use App\Http\Controllers\Controller as ControllersController;


use App\Modules\WebsiteApi\Category\Actions\GetAllCategoryGroup;
use App\Modules\WebsiteApi\Category\Actions\GetAllCategoryByCategoryGroupId;

use App\Modules\WebsiteApi\Category\Actions\GetAllCategory;
use App\Modules\WebsiteApi\Category\Actions\GetAllCategoryParent;
use App\Modules\WebsiteApi\Category\Actions\GetSingelCategory;
use App\Modules\WebsiteApi\Category\Actions\GetAllNavCategory;
use App\Modules\WebsiteApi\Category\Actions\GetAllFeaturedCategory;
use App\Modules\WebsiteApi\Category\Actions\GetAllSubCategoryByCategoryId;
use App\Modules\WebsiteApi\Category\Actions\GetAdvertiseByCategoryId;
use App\Modules\WebsiteApi\Category\Actions\GetBrandsByCategoryId;
use App\Modules\WebsiteApi\Category\Actions\GetVarientsByCategoryId;
use App\Modules\WebsiteApi\Category\Actions\GetMinMaxPriceByCategoryId;

class Controller extends ControllersController
{

    public function GetAllCategorygroups()
    {
        $data = GetAllCategoryGroup::execute();
        return $data;
    }

    public function GetCategoryByCategoryGroupId($slug)
    {
        $data = GetAllCategoryByCategoryGroupId::execute($slug);
        return $data;
    }
    public function GetAllCategory()
    {
        $data = GetAllCategory::execute();
        $response = entityResponse($data);
        $response->header('Cache-Control', 'public, max-age=300')
            ->header('Expires', now()->addMinutes(60)->toRfc7231String());
        return $response;
    }
    public function GetAllCategoryParent()
    {
        $data = GetAllCategoryParent::execute();
        $response = entityResponse($data);
        $response->header('Cache-Control', 'public, max-age=300')
            ->header('Expires', now()->addMinutes(60)->toRfc7231String());
        return $response;
    }
    public function GetSingelCategory($slug)
    {
        $data = GetSingelCategory::execute($slug);
        return $data;
    }
    public function GetAllFeaturedCategory()
    {
        $data = GetAllFeaturedCategory::execute();
        $response = entityResponse($data);
        $response->header('Cache-Control', 'public, max-age=300')
            ->header('Expires', now()->addMinutes(25)->toRfc7231String());
        return $response;
    }
    public function GetAllNavCategory()
    {
        $data = GetAllNavCategory::execute();
        $response = entityResponse($data);
        $response->header('Cache-Control', 'public, max-age=300')
            ->header('Expires', now()->addMinutes(25)->toRfc7231String());
        return $response;
    }
    public function GetAllSubCategoryByCategoryId($slug)
    {
        $data = GetAllSubCategoryByCategoryId::execute($slug);
        return $data;
    }
    public function GetAdvertiseByCategoryId($slug)
    {
        $data = GetAdvertiseByCategoryId::execute($slug);
        return $data;
    }
    public function GetBrandsByCategoryId($slug)
    {
        $data = GetBrandsByCategoryId::execute($slug);
        return $data;
    }
    public function GetVarientsByCategoryId($slug)
    {
        $data = GetVarientsByCategoryId::execute($slug);
        return $data;
    }
    public function GetMinMaxPriceByCategoryId($slug)
    {
        $data = GetMinMaxPriceByCategoryId::execute($slug);
        return $data;
    }
}
