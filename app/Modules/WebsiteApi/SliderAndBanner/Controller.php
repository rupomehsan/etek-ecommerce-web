<?php

namespace App\Modules\WebsiteApi\SliderAndBanner;

use App\Modules\WebsiteApi\SliderAndBanner\Actions\HeroSlider;
use App\Modules\WebsiteApi\SliderAndBanner\Actions\HeroSliderSideBanner;

use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function HeroSlider()
    {
        $data = HeroSlider::execute();
        $response = entityResponse($data);
        $response->header('Cache-Control', 'public, max-age=3000')
            ->header('Expires', now()->addMinutes(60)->toRfc7231String());
        return $response;
    }
    public function HeroSliderSideBanner()
    {
        $data = HeroSliderSideBanner::execute();
        $response = entityResponse($data);
        $response->header('Cache-Control', 'public, max-age=60')
            ->header('Expires', now()->addMinutes(60)->toRfc7231String());
        return $response;
    }
}
