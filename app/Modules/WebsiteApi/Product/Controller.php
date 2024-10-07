<?php

namespace App\Modules\WebsiteApi\Product;

use App\Http\Controllers\Controller as ControllersController;

use App\Modules\WebsiteApi\Product\Actions\GetAllProduct;
use App\Modules\WebsiteApi\Product\Actions\GetAllBestSellingProduct;
use App\Modules\WebsiteApi\Product\Actions\GetAllFeaturedProduct;
use App\Modules\WebsiteApi\Product\Actions\GetAllFeaturedProductsByCategoryId;
use App\Modules\WebsiteApi\Product\Actions\GetAllProductsByBrandId;
use App\Modules\WebsiteApi\Product\Actions\GetAllProductsByCategoryId;
use App\Modules\WebsiteApi\Product\Actions\GetProductDetails;
use App\Modules\WebsiteApi\Product\Actions\GetAllProductOffers;
use App\Modules\WebsiteApi\Product\Actions\GetAllOfferProductsByOfferId;
use App\Modules\WebsiteApi\Product\Actions\GetInitialProductDetails;
use App\Modules\WebsiteApi\Product\Actions\GetSingleCategoryGroupWithProduct;
use App\Modules\WebsiteApi\Product\Actions\GetProductCategoryVarients;
use App\Modules\WebsiteApi\Product\Actions\GetProductCategoryWiseBrands;
use App\Modules\WebsiteApi\Product\Actions\GetAllProductsByCategoryIdWithVerientAndBrand;
use App\Modules\WebsiteApi\Product\Actions\GetBrandsByProduct;
use App\Modules\WebsiteApi\Product\Actions\GetProducts;
use App\Modules\WebsiteApi\Product\Actions\GetRelatedGenericProduct;
use App\Modules\WebsiteApi\Product\Actions\SearchProducts;

class Controller extends ControllersController
{

    public function SearchProducts()
    {
        $data = SearchProducts::execute();
        return entityResponse($data);
    }
    public function GetProducts()
    {
        $data = GetProducts::execute();
        return response()
                ->json($data)
                ->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(60)
                ->toRfc7231String());
    }
    public function GetBrandsByProduct()
    {
        $data = GetBrandsByProduct::execute();
        return response()
                ->json([
                    "data" => $data,
                    "status" => "success",
                    "statusCode" => 200,
                    "message" => ""
                ]);
                // ->header('Cache-Control', 'public, max-age=300')
                // ->header('Expires', now()->addMinutes(60)
                // ->toRfc7231String());
    }
    public function GetAllProduct()
    {
        $data = GetAllProduct::execute();
        return $data;
    }
    public function GetAllBestSellingProduct()
    {
        $data = GetAllBestSellingProduct::execute();
        return $data;
    }
    public function GetAllFeaturedProduct()
    {
        $data = GetAllFeaturedProduct::execute();
        return entityResponse($data);
    }
    public function GetAllFeaturedProductsByCategoryId($slug)
    {
        $data = GetAllFeaturedProductsByCategoryId::execute($slug);
        return $data;
    }
    public function GetAllProductsByBrandId($slug)
    {
        $data = GetAllProductsByBrandId::execute($slug);
        return $data;
    }
    public function GetRelatedGenericProduct($slug)
    {
        $data = GetRelatedGenericProduct::execute($slug);
        return $data;
    }
    public function GetAllProductsByCategoryId($slug)
    {
        $data = GetAllProductsByCategoryId::execute($slug);
        return $data;
    }
    public function GetProductDetails($slug)
    {
        $data = GetProductDetails::execute($slug);
        return $data;
    }
    public function GetInitialProductDetails($slug)
    {
        $data = GetInitialProductDetails::execute($slug);
        // if (!$data) {
        //     return messageResponse('Data not found...', [], 404, 'error');
        // }
        $response = entityResponse($data);
        return $response;
    }
    public function GetAllProductOffers()
    {
        $data = GetAllProductOffers::execute();
        return $data;
    }
    public function GetAllOfferProductsByOfferId($slug)
    {
        $data = GetAllOfferProductsByOfferId::execute($slug);
        return $data;
    }
    public function GetSingleCategoryGroupWithProduct($slug)
    {
        $data = GetSingleCategoryGroupWithProduct::execute($slug);
        return $data;
    }
    public function GetProductCategoryVarients($slug)
    {
        $data = GetProductCategoryVarients::execute($slug);
        return $data;
    }
    public function GetProductCategoryBrands($slug)
    {
        $data = GetProductCategoryWiseBrands::execute($slug);
        return $data;
    }
    public function GetAllProductsByCategoryIdWithVerientAndBrand($slug)
    {
        $data = GetAllProductsByCategoryIdWithVerientAndBrand::execute($slug);
        return response()
                ->json($data)
                ->header('Cache-Control', 'public, max-age=300')
                ->header('Expires', now()->addMinutes(60)
                ->toRfc7231String());
    }
}
