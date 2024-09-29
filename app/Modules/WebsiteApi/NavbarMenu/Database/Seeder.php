<?php

namespace App\Modules\WebsiteApi\NavbarMenu\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\WebsiteApi\NavbarMenu\Database\Seeder"
     */

    static $model = \App\Modules\WebsiteApi\NavbarMenu\Models\Model::class;
    static $NavmenuItemModel = \App\Modules\WebsiteApi\NavbarMenu\Models\NavmenuItemModel::class;
    static $NavmenuDetailsModel = \App\Modules\WebsiteApi\NavbarMenu\Models\NavmenuDetailsModel::class;

    public function run(): void
    {

        $menu = [
            [
                'title' => 'Home',
                'icon_image' => 'avatar.png',
                "external_link" => "/",
                "is_visible" => true,
                "childrens" => [],
            ],
            [
                'title' => 'About',
                'icon_image' => 'avatar.png',
                "external_link" => "/about",
                "is_visible" => true,
                "childrens" => [],
            ],
            [
                'title' => 'Blogs',
                'icon_image' => 'avatar.png',
                "external_link" => "/blogs",
                "is_visible" => true,
                "childrens" => [
                    [
                        "title" =>  "Blog Details",
                        "serial" => "",
                        "is_visible" => true,
                        "goto_external_link" => 0,
                        "description" => "description"
                    ],
                ],
            ],
            [
                'title' => 'Contact',
                'icon_image' => 'avatar.png',
                "external_link" => "/contact",
                "is_visible" => true,
                "childrens" => [],
            ],

        ];

        self::$model::truncate();
        self::$NavmenuItemModel::truncate();
        self::$NavmenuDetailsModel::truncate();
        foreach ($menu as $key => $item) {
            $menu = self::$model::create([
                "title" => $item['title'],
                "icon_image" => $item['icon_image'],
                "is_visible" => true,
                "serial" => $key + 1,
                "goto_external_link" => $item["goto_external_link"] ?? 0,
                "external_link" => $item["external_link"] ?? "",
            ]);

            if (isset($item["description"])) {
                self::$NavmenuDetailsModel::create([
                    "navbar_menu_id" => $menu->id,
                    "navbar_menu_items_id" => null,
                    "title" => $item['title'],
                    "description" => $item["description"],
                ]);
            }

            foreach ($item["childrens"] as $sub_key => $sub_item) {
                $menu_item = self::$NavmenuItemModel::create([
                    "navbar_menus_id" => $menu->id,
                    "title" => $sub_item["title"],
                    "serial" => $sub_key + 1,
                    "goto_external_link" => $sub_item["goto_external_link"] ?? 0,
                    "external_link" => $sub_item["external_link"] ?? "",
                    "is_multiple" => $sub_item["is_multiple"] ?? 0,
                    "is_visible" => true,
                ]);

                if (isset($sub_item["description"])) {
                    self::$NavmenuDetailsModel::create([
                        "navbar_menu_id" => $menu->id,
                        "navbar_menu_items_id" => $menu_item->id,
                        "title" => $sub_item["title"],
                        "description" => $sub_item["description"],
                    ]);
                }
            }
        }
    }

    public function about_us()
    {
        return <<<HTML
        <div class="container"><h1 class="content_title pb-2">ETECH Ltd</h1><div class=""><h2>About ETECH</h2><p> ETECH has been founded on 1 March 2007. From then to now, ETECH has won the heart of many people and now is a country-wide renowned brand. That has been possible due to the hard work ETECH has done to satisfy its customers. Having the aim to satisfy customers, providing customers with their required products, and being true to their motto, “Customers Come First,” has brought ETECH to the top choice for E-Commerce Sites in Bangladesh and is recognized as the largest Computer and Tech retailer. ETECH has over 700 employees and is growing more and more, working diligently to fulfill the Main Criteria of ETECH’s Motto or Vision. ETECH is located in 6 Central territories in Dhaka, Gazipur, Chattogram, Khulna, Rajshahi, and Rangpur. ETECH has a total of 17 Physical outlets all over the country; selling genuine Tech products. Among them, 9 outlets are in Dhaka as it’s the capital city. ETECH also has two branches in Chittagong; the commercial capital of Bangladesh. There is one Branch in Gazipur, one in Khulna, one in Rajshahi, and one Branch in Rangpur. Apart from the Physical Branches, we also have our successful E-Commerce website. </p><h2>ISO Certified Quality Management System</h2><p> ETECH has always managed the standards for Quality management. In 2022, ETECH Ltd. was certified with the well-known "ISO 9001:2015 certification". This marked a groundbreaking achievement for us. As an "ISO 9001:2015 certified" organization; we consistently maintain all sorts of regulatory requirements to provide the best products and services to meet any customer requirement. </p><h2>The Main Goal and Aim</h2><p> We are ETECH, and we are here to help you with all your technology needs. We aim to provide all the requirements of our customers and help them satisfy their needs, wants, and desires. We delight in seeing our customers happy and satisfied with our resiliency in providing them with their products. Our complete focus is on the customers. We keep tabs and records on what our customers want, and we try our best to bring that to them. We are already providing our customers with a delivery system so that they can order online and receive their products from their area. They do not have to travel long distances to get their desired product. </p><h2>Services Being Provided</h2><p> We are a Tech-based product seller. We provide our customers with the best quality products at the most reasonable price. We have varieties of products that our customers can choose from. The product range starts from Desktop PC, Laptop, Gaming PC, Mobile Phones, UPS, Tablet PC, Graphics Tablet, Monitors, Office Equipment, Cameras, Security Cameras, Televisions, and many other products. Each of our products is checked and reviewed before it is sold to our loyal customers. You are our driving force to better ourselves in all aspects of the service-providing sector. We strive to become a Perfectionist Company that delivers everything, word for word. </p><h2>Top-Selling Brands</h2><p> We have many top-selling brands that gained our attention to focus on them. These brands are Antec, Asrock, Bitfenix, Cryorig, Deli, EKWB, ESET, Galax, Gamdias, GEiL, Infocus, KWG, Lian Li, MaxGreen, Noctua, Razer, RnM, Team, XFX, Zyxel to name a few. As being top-selling and demanding brands, you will be able to get the latest updated products and service facilities more. You will also get better after-sales service from us. If any trouble occurs with these brand products, we will be able to solve it very easily. After fixing the problem you will be able to get the product in pristine condition just like if it is still new. These brand products are very high-quality products that provide the best service to the customers. We ensure that you are getting the best quality product. You can freely buy top-selling brand products without having to think twice about what you are buying. We also provide our customers with the best pricing for the products compared to anywhere in Bangladesh. You can stay easy and relax knowing that one of our goals is to provide the customer with the best product at the most reasonable pricing. We ensure that our customers are satisfied with our product and the pricing. </p><h2>Dealing with Corporate Sector</h2><p> We have also been working with Corporate Customers from the beginning of ETECH. We are working with many well-known offices in Bangladesh and have a very good relationship with them. We have worked with many Corporate offices like the bank, hospitals, Government organizations, Multi-National Companies, and Telecom Companies, to name a few. We provide them with all the Tech product-related support and facilities for their business. The Tech facilities that we provide are all IT-related hardware products like network-based products, servers and routers, laptops, desktops, printers, and other Tech-related hardware accessories. </p><h2>Customer Satisfaction</h2><p> We have been in the market for a long time, and we have come to know what the customers want and desire. We have made changes around our customers so that we will be able to fulfill the desires of each of our customers. We want to improve more and more to be able to give everyone their desired or dreamed products. We are providing online buying opportunities for our customers, and providing delivery service for all of our products all over Bangladesh. We provide the best after-sales customer service to our customers to make them feel that we do care about their possession and provide them with the best solutions for their problems. </p><h2>The Brand That Cares For You</h2><p> This is ETECH! A brand that is truly concerned about its customers and loyally provides all the needs of the customers. Customers come first to this Company. Our customers will receive the best service and deals that ETECH offers. To us, our customer’s wants and needs take the top priority. We always have and will aim to provide the perfect result to our loyal customers. And our after-sales service will ensure that no one of our customers will come to us with the same issue twice. Come and experience the service, product, and facilities ETECH offers. </p></div></div>
        HTML;
    }
}
