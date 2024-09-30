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
use App\Modules\WebsiteApi\Product\Actions\GetRelatedGenericProduct;
use App\Modules\WebsiteApi\Product\Actions\GetAllSummerSaleProducts;
use App\Modules\WebsiteApi\Product\Actions\GetAllSuperSaveProducts;
use App\Modules\WebsiteApi\Product\Actions\GetAllFlashSaleProducts;
use App\Modules\WebsiteApi\Product\Actions\GetAllPopulerProducts;
use App\Modules\WebsiteApi\Product\Actions\GetAllOfferProducts;
use App\Modules\WebsiteApi\Product\Actions\GetAllProductsByFeaturedCategory;
use App\Modules\WebsiteApi\Product\Actions\GetAllTopOffersWithProducts;

class Controller extends ControllersController
{

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
        return $data;
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
        return $data;
    }
    public function GetAllSummerSaleProducts()
    {
        $data = GetAllSummerSaleProducts::execute();
        return $data;
    }
    public function GetAllPopulerProducts()
    {
        $data = GetAllPopulerProducts::execute();
        return $data;
    }
    public function GetAllFlashSaleProducts()
    {
        $data = GetAllFlashSaleProducts::execute();
        return $data;
    }
    public function GetAllSuperSaveProducts()
    {
        $data = GetAllSuperSaveProducts::execute();
        return $data;
    }
    public function GetAllOfferProducts()
    {
        $data = GetAllOfferProducts::execute();
        return $data;
    }
    public function GetAllProductsByFeaturedCategory()
    {
        $data = GetAllProductsByFeaturedCategory::execute();
        return $data;
    }
    public function GetAllTopOffersWithProducts()
    {
        $data = GetAllTopOffersWithProducts::execute();
        return $data;
    }
}
