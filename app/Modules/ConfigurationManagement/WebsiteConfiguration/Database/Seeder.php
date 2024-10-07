<?php

namespace App\Modules\ConfigurationManagement\WebsiteConfiguration\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ConfigurationManagement\WebsiteConfiguration\Database\Seeder"
     *
     */

    static $SettingTitleModel = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingTitleModel::class;
    static $SettingValueModel = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingValueModel::class;


    public function setting_save($settings)
    {
        foreach ($settings as $title) {
            $setting_title = self::$SettingTitleModel::create([
                'title' => $title['title'],
            ]);

            foreach ($title['values'] as $value) {
                self::$SettingValueModel::create([
                    'setting_title_id' => $setting_title->id,
                    'title' => $setting_title->title,
                    'value' => isset($value['value']) ? $value['value'] : null,
                    // 'values' => array_key_exists('values', $value) ? $value['values'] : null,
                ]);
            }
        }
    }

    public function run()
    {
        self::$SettingTitleModel::truncate();
        self::$SettingValueModel::truncate();

        $basic_settings = [
            [
                "group" => "basic_info",
                "title" => "site_name",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
            [
                "group" => "basic_info",
                "title" => "header_logo",
                "values" => [
                    [
                        "value" => "frontend/images/etek_logo.png",
                    ],
                ]
            ],

            [
                "group" => "basic_info",
                "title" => "footer_logo",
                "values" => [
                    [
                        "value" => "frontend/images/etek_logo.png",

                    ],
                ]
            ],
            [

                "group" => "basic_info",
                "title" => "fabicon",
                "values" => [
                    [
                        "value" => "frontend/images/etek_favicon.png",

                    ],
                ]
            ],
            [

                "group" => "basic_info",
                "title" => "payment_gateway_logo",
                "values" => [
                    [
                        "value" => "frontend/images/etek_favicon.png",

                    ],
                ]
            ],

            [

                "group" => "basic_info",
                "title" => "copy_right",
                "values" => [
                    [
                        "value" => "2019-24 Copy Right by ETEK.com.bd",

                    ],
                ]
            ],

            [
                "group" => "basic_info",
                "title" => "shiping_on_order",
                "values" => [
                    [
                        "value" => "free shipping on order over 5000 TK.",

                    ],
                ]
            ],

            [
                "group" => "basic_info",
                "title" => "breaking_news",
                "values" => [
                    [
                        "value" => "***প্রিয় ক্রেতামন্ডলী, প্রযুক্তি পণ্যের মূল্য অস্থিতিশীল হওয়ার কারণে যেকোন মুহূর্তে যেকোন প্রযুক্তি পণ্যের মূল্য পরিবর্তন হতে পারে। তাই অর্ডার করার পূর্বে অবশ্যই উল্লেখিত নাম্বারগুলোতে “মোবাইলঃ- ০১৭৩৩০৮০৩৭৬, ০১৭৩৩০৮০৩৫০, ফোনঃ- +৮৮০ ২-৫৫১৫৩৪৩০” যোগাযোগ করে পন্যের স্টক ও ডেলিভারি সম্পর্কে জেনে নেয়ার জন্য বিশেষভাবে অনুরোধ করা যাচ্ছে। এবং পছন্দের প্রযুক্তিপণ্য নেয়ার জন্য শপ-এ আসতে চাইলে, আজই চলে আসুন আমাদের শপ মাল্টিপ্ল্যান সেন্টারের লেভেলঃ-০৪, শপঃ-(৪০৭-৪০৯), নিউ এলিফ্যান্ট রোড, ঢাকা ১২০৫। ***",

                    ],
                ]
            ],

        ];

        $this->setting_save($basic_settings);

        $contact_information_settings = [
            [
                "group" => "contact_information",
                "title" => "phone_numbers",
                "values" => [
                    [
                        "value" => "+8801793-199803"
                    ],
                    [
                        "value" => "123-456-7898",
                    ],
                ],

            ],
            [
                "group" => "contact_information",
                "title" => "whatsapp",
                "values" => [
                    [
                        "value" => "",
                    ],
                ]
            ],
            [
                "group" => "contact_information",
                "title" => "telegram",
                "values" => [
                    [
                        "value" => "",
                    ],
                ]
            ],
            [
                "group" => "contact_information",
                "title" => "emails",
                "values" => [
                    [
                        "value" => "support@etek.com.bd",
                    ],
                ]
            ],
            [
                "group" => "contact_information",
                "title" => "map_link",
                "values" => [
                    [
                        "value" => '<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6423.24786250228!2d25.459764!3d36.394097!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1722161641522!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                    ],
                ]
            ],

            [
                "group" => "contact_information",
                "title" => "address",
                "values" => [
                    [
                        "value" => "ETEK BD, Bangladesh-3654123",
                    ],
                ]
            ],
        ];

        $this->setting_save($contact_information_settings);

        $social_media_settings = [
            [
                "group" => "social_media",
                "title" => "facebook",
                "values" => [
                    [
                        "value" => "https://www.facebook.com/etekbd/",

                    ],
                ]
            ],
            [
                "group" => "social_media",
                "title" => "youtube",
                "values" => [
                    [
                        "value" => "https://www.youtube.com/@etekbd",

                    ],
                ]
            ],


        ];

        $this->setting_save($social_media_settings);

        $seo_settings = [
            [
                "group" => "seo",
                "title" => "title",
                "values" => [
                    [
                        "value" => "ETEK Enterprise: Your One-Stop Shop for Electronics, Gadgets, and Medicines",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "description",
                "values" => [
                    [
                        "value" => "Discover the best in electronics, cutting-edge gadgets, and essential medicines at ETEK Enterprise. Our wide range of high-quality products ensures you find exactly what you need, whether it's the latest tech innovations or reliable health solutions. Shop with confidence, enjoy great deals, and experience exceptional customer service. Stay connected with ETEK Enterprise - where technology meets healthcare.",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "image",
                "values" => [
                    [
                        "value" => "frontend/images/etek_logo.png",
                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "keywords",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "tag",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "schema_tag",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
        ];

        $this->setting_save($seo_settings);

        $pages = [
            [

                "group" => 'pages',
                "title" => "short_intro",
                "values" => [
                    [
                        "value" => $this->short_intro(),
                    ],
                ]
            ],
            [

                "group" => 'pages',
                "title" => "home_page_descrption",
                "values" => [
                    [
                        "value" => $this->home_page_long_intro(),
                    ],
                ]
            ],
            [

                "group" => 'pages',
                "title" => "about_us",
                "values" => [
                    [
                        "value" => $this->about_us(),
                    ],
                ]
            ],
            [

                "group" => 'pages',
                "title" => "terms_and_condition",
                "values" => [
                    [
                        "value" => $this->terms_and_condition(),
                    ],
                ]
            ],
            [

                "group" => 'pages',
                "title" => "return_and_exchange",
                "values" => [
                    [
                        "value" => $this->return_and_exchange(),
                    ],
                ]
            ],
            [

                "group" => 'pages',
                "title" => "shiping_and_delivery",
                "values" => [
                    [
                        "value" => $this->shiping_and_delivery(),
                    ],
                ]
            ],
            [

                "group" => 'pages',
                "title" => "coockies_policy",
                "values" => [
                    [

                        "value" => $this->coockies_policy(),
                    ],
                ]
            ],
            [

                "group" => 'pages',
                "title" => "sitemap",
                "values" => [
                    [
                        "value" => $this->site_map(),
                    ],
                ]
            ],
        ];

        $this->setting_save($pages);

        $order = [
            [

                "group" => 'delivery_charge',
                "title" => "inside_dhaka",
                "values" => [
                    [
                        "value" => '50',
                    ],
                ]
            ],
            [

                "group" => 'delivery_charge',
                "title" => "outside_dhaka",
                "values" => [
                    [
                        "value" => '150',
                    ],
                ]
            ],

        ];
        $this->setting_save($order);
    }

    public function site_map()
    {
        return <<<HTML
        <div class="footer-main">
            <div class="footer-box">
                <div class="footer-title mobile-title"><h5>about</h5></div>
                <div class="footer-contant">
                    <div class="footer-logo">
                        <a href="/"><img src="/cache/frontend/images/etek_logo.png" class="img-fluid" alt="logo"></a>
                    </div>
                    <div>
                        <h2 class="mb-3" style="font-size:20px;">ETEK Enterprise: Your One-Stop Shop for Electronics, Gadgets, and Medicines</h2>
                        <p style="text-align:justify;">
                            Discover the best in electronics, cutting-edge gadgets, and essential medicines at ETEK Enterprise. Our wide range of high-quality products ensures you find exactly what you need, whether it's the latest tech innovations or reliable health solutions. Shop with confidence, enjoy great deals, and experience exceptional customer service. Stay connected with ETEK Enterprise - where technology meets healthcare.
                        </p>
                    </div>
                    <ul class="sosiyal">
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-box">
                <div class="footer-title"><h5>my account</h5></div>
                <div class="footer-contant">
                    <ul>
                        <li><a href="/about">about us</a></li>
                        <li><a href="/contact">contact us</a></li>
                        <li><a href="/terms_conditions">terms &amp; conditions</a></li>
                        <li><a href="/returns_exchanges">returns &amp; exchanges</a></li>
                        <li><a href="/shipping_delivery">shipping &amp; delivery</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-box">
                <div class="footer-title"><h5>contact us</h5></div>
                <div class="footer-contant">
                    <ul class="contact-list">
                        <li><i class="fa fa-map-marker"></i>ETEK BD <br> bangladesh-<span>3654123</span></li>
                        <li><i class="fa fa-phone"></i>call us: <span>123-456-7898</span></li>
                        <li><i class="fa fa-envelope-o"></i>email us: support@etek.com.bd</li>
                        <li><i class="fa fa-fax"></i>fax <span>123456</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-box">
                <div class="footer-title"><h5>newsletter</h5></div>
                <div class="footer-contant">
                    <div class="newsletter-second">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="enter full name">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="enter email address">
                                <span class="input-group-text"><i class="ti-email"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0)" class="btn btn-solid btn-sm">submit now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }

    public function short_intro()
    {
        return "ETEK Enterprise: Your One-Stop Shop for Electronics, Gadgets, and Medicines";
    }
    public function home_page_long_intro()
    {
        return <<<HTML
        <div class="product_info_content mb-2" id="product_info_content"><div class="product_d_inner"><h1>Best Computer, Laptop, Gaming PC, PC Components, Retail &amp; Wholesale Online Shop in Bangladesh </h1><h2>Best Desktop PC Shop in Bangladesh</h2><p> ETEK BD is the Best<a href="https://www.etek.com.bd/desktop-pc"> Desktop PC</a> Shop in Bangladesh, providing the best quality PCs at the most competitive prices. With 21 years of PC building experience, you can be sure that the PCs here are reliable, powerful, and cost-effective. Our knowledgeable executives are always on hand to offer expert advice and support, ensuring that you’re getting the best value for your money. Whether you’re a casual user or a professional in need of a powerhouse machine, ETEK BD is The Best Desktop PC Shop in Bangladesh is the perfect destination for all your PC needs. </p><h2>Best Gaming PC Shop in Bangladesh</h2><p> If you're looking for the best <a href="https://www.etek.com.bd/gaming-pc">gaming PC </a>shop in Bangladesh, then you've come to the right place! At our store, we offer a wide selection of gaming PCs that are perfect for any type of gaming experience. Our knowledgeable staff is always here to answer any questions you may have, and help you find the perfect gaming PC that fits both your budget and gaming needs. <a href="https://www.etek.com.bd/direction">Visit us today</a> and experience the best gaming PC shop in Bangladesh. </p><h2>Best Office PC Shop in Bangladesh</h2><p> If you're looking for the best<a href="https://www.etek.com.bd/binary-pc"> office PC </a>shop in Bangladesh, then you've come to the right place. At ETEK BD, we provide the best quality laptops, desktops, and accessories to get your office up and running with ease. We offer attractive prices, reliable service, and prompt delivery. Our friendly staff is always ready to answer any questions you have and provide you with helpful advice. So, come on down and see for yourself why ETEK BD is the best office PC shop in Bangladesh. </p><h2>Best Graphics PC Shop in Bangladesh</h2><p> Welcome to the best <a href="https://www.etek.com.bd/graphic-pc">graphics PC shop in Bangladesh</a> at ETEK BD! Here, we make your dreams come true by providing only the best high-end components and the latest technologies. Our PCs are designed with cutting-edge graphics and performance in mind, so you can experience maximum immersion and power for the latest graphics design. Plus, our expertise in PC building lets you <a href="https://www.etek.com.bd/tools/pc_builder"> customize your PC </a>to meet your exact needs. Get ready to take your graphics designing experience to the next level at ETEK BD. </p><h2>Best &nbsp;Video Editing PC Shop in Bangladesh</h2><p> ETEK BD specializes in helping customers build their ideal <a href="https://www.etek.com.bd/graphic-pc">video editing PC</a>. Our knowledgeable and experienced staff will provide you with personalized recommendations for each component to ensure your PC meets the specific needs of your video editing workflow. We’ll help you build a powerful, reliable system that is designed to allow you to produce professional-quality videos quickly and efficiently. With our Build Your Video Editing PC, we guarantee that you’ll get the best possible value for your money and be able to edit videos with ease. </p><h2>Best Server PC Shop in Bangladesh. Build Your Server PC at ETEK BD.</h2><p> ETEK BD is the premier shop for<a href="https://www.etek.com.bd/tools/pc_builder"> building your server PC in Bangladesh</a>. With top-of-the-line components from leading brands, custom PC building services, and knowledgeable, friendly staff, ETEK BD is the best choice for constructing your server PC. All of the components are top-notch and tested to ensure the highest quality performance for your server, and the staff can assist with any questions or concerns you may have. With the combination of quality hardware and superior customer service, ETEK BD is the premier shop for building your <a href="https://www.etek.com.bd/server">server PC</a>.<br> &nbsp; </p><h2>Best PC case shop at an affordable price&nbsp;in Bangladesh</h2><p> We are the best PC case shop in Bangladesh because we provide good quality products at an affordable price. Our products are made from durable materials and are designed to protect your computers from damage. We also offer a wide variety of styles and colors to choose from <a href="https://www.etek.com.bd/darkflash">darkflash </a>&amp; <a href="https://www.etek.com.bd/cooler-master">Cooler Master</a>, so you can find the perfect <a href="https://www.etek.com.bd/case">pc case </a>for your needs. </p><h2>Best Computer Motherboard shop at an affordable price in Bangladesh</h2><p> Need a new <a href="https://www.etek.com.bd/motherboard">computer motherboard</a> but don't want to spend a fortune? Check out our list of the best computer motherboards for an affordable price in Bangladesh. We've got options for every budget, so you can find the perfect motherboard for your needs. Whether you're looking for a high-end option for gaming or a budget-friendly option for work, we've got you covered.&nbsp; </p><p>No matter what your needs are, we're sure you'll <a href="https://www.etek.com.bd/motherboard">find</a> the perfect computer motherboard on our website.</p><h2>Best &nbsp;Graphics Card shop at an affordable price in Bangladesh&nbsp;</h2><p> If you're looking for the best graphics card shop at an affordable price in Bangladesh, then you've come to the right place. We offer a wide range of graphics cards from leading brands, all at great prices. Our selection includes cards for both desktops and laptops, so you're sure to find the perfect card for your needs. And if you're not sure which card is right for you, our friendly and knowledgeable staff will be happy to help you choose the perfect card for your budget and needs. </p><p>So come and visit us today, and see for yourself why we're the best place to buy <a href="https://www.etek.com.bd/graphics-card">graphics cards</a> in Bangladesh.</p><h2>Best POS Printer shop at an affordable price in Bangladesh</h2><p> Are you looking for a POS printer shop in Bangladesh? Look no further than Printer Point. We offer the best <a href="https://www.etek.com.bd/pos-printer">POS printers</a> at an affordable price. Our printers are known for their quality and durability. We have a wide range of printers to choose from, so you can find the perfect one for your needs. </p><h2>Best Barcode Printer &amp; Scanner shop at an affordable price in Bangladesh</h2><p> In this fast-paced world, a barcode printer &amp; scanner is a must-have for any business. At our shop, we offer the best barcode printer &amp; scanner at an affordable price in Bangladesh. We have a wide range of barcode printers &amp; scanners to choose from, so you can find the perfect one for your business. We also offer a wide range of accessories, so you can get everything you need to get started. </p><h2>Best Computer Monitor shop at an affordable price in Bangladesh</h2><p> We are the best <a href="https://www.etek.com.bd/monitor">computer monito</a>r shop at an affordable price in Bangladesh. With years of experience in the industry, we provide top-quality products and services to our customers. Our <strong>monitors</strong> are perfect for <a href="https://www.etek.com.bd/hp">gaming</a>, <a href="https://www.etek.com.bd/asus-monitor-price">video editing</a>, and graphic design. We also offer a wide variety of other<a href="https://www.etek.com.bd/peripheral"> computer accessories</a>. Shop now. </p></div></div>
        HTML;
    }
    public function about_us()
    {
        return <<<HTML
             <div class=""><h2>About ETECH</h2><p> ETECH has been founded on 1 March 2007. From then to now, ETECH has won the heart of many people and now is a country-wide renowned brand. That has been possible due to the hard work ETECH has done to satisfy its customers. Having the aim to satisfy customers, providing customers with their required products, and being true to their motto, “Customers Come First,” has brought ETECH to the top choice for E-Commerce Sites in Bangladesh and is recognized as the largest Computer and Tech retailer. ETECH has over 700 employees and is growing more and more, working diligently to fulfill the Main Criteria of ETECH’s Motto or Vision. ETECH is located in 6 Central territories in Dhaka, Gazipur, Chattogram, Khulna, Rajshahi, and Rangpur. ETECH has a total of 17 Physical outlets all over the country; selling genuine Tech products. Among them, 9 outlets are in Dhaka as it’s the capital city. ETECH also has two branches in Chittagong; the commercial capital of Bangladesh. There is one Branch in Gazipur, one in Khulna, one in Rajshahi, and one Branch in Rangpur. Apart from the Physical Branches, we also have our successful E-Commerce website. </p><h2>ISO Certified Quality Management System</h2><p> ETECH has always managed the standards for Quality management. In 2022, ETECH Ltd. was certified with the well-known "ISO 9001:2015 certification". This marked a groundbreaking achievement for us. As an "ISO 9001:2015 certified" organization; we consistently maintain all sorts of regulatory requirements to provide the best products and services to meet any customer requirement. </p><h2>The Main Goal and Aim</h2><p> We are ETECH, and we are here to help you with all your technology needs. We aim to provide all the requirements of our customers and help them satisfy their needs, wants, and desires. We delight in seeing our customers happy and satisfied with our resiliency in providing them with their products. Our complete focus is on the customers. We keep tabs and records on what our customers want, and we try our best to bring that to them. We are already providing our customers with a delivery system so that they can order online and receive their products from their area. They do not have to travel long distances to get their desired product. </p><h2>Services Being Provided</h2><p> We are a Tech-based product seller. We provide our customers with the best quality products at the most reasonable price. We have varieties of products that our customers can choose from. The product range starts from Desktop PC, Laptop, Gaming PC, Mobile Phones, UPS, Tablet PC, Graphics Tablet, Monitors, Office Equipment, Cameras, Security Cameras, Televisions, and many other products. Each of our products is checked and reviewed before it is sold to our loyal customers. You are our driving force to better ourselves in all aspects of the service-providing sector. We strive to become a Perfectionist Company that delivers everything, word for word. </p><h2>Top-Selling Brands</h2><p> We have many top-selling brands that gained our attention to focus on them. These brands are Antec, Asrock, Bitfenix, Cryorig, Deli, EKWB, ESET, Galax, Gamdias, GEiL, Infocus, KWG, Lian Li, MaxGreen, Noctua, Razer, RnM, Team, XFX, Zyxel to name a few. As being top-selling and demanding brands, you will be able to get the latest updated products and service facilities more. You will also get better after-sales service from us. If any trouble occurs with these brand products, we will be able to solve it very easily. After fixing the problem you will be able to get the product in pristine condition just like if it is still new. These brand products are very high-quality products that provide the best service to the customers. We ensure that you are getting the best quality product. You can freely buy top-selling brand products without having to think twice about what you are buying. We also provide our customers with the best pricing for the products compared to anywhere in Bangladesh. You can stay easy and relax knowing that one of our goals is to provide the customer with the best product at the most reasonable pricing. We ensure that our customers are satisfied with our product and the pricing. </p><h2>Dealing with Corporate Sector</h2><p> We have also been working with Corporate Customers from the beginning of ETECH. We are working with many well-known offices in Bangladesh and have a very good relationship with them. We have worked with many Corporate offices like the bank, hospitals, Government organizations, Multi-National Companies, and Telecom Companies, to name a few. We provide them with all the Tech product-related support and facilities for their business. The Tech facilities that we provide are all IT-related hardware products like network-based products, servers and routers, laptops, desktops, printers, and other Tech-related hardware accessories. </p><h2>Customer Satisfaction</h2><p> We have been in the market for a long time, and we have come to know what the customers want and desire. We have made changes around our customers so that we will be able to fulfill the desires of each of our customers. We want to improve more and more to be able to give everyone their desired or dreamed products. We are providing online buying opportunities for our customers, and providing delivery service for all of our products all over Bangladesh. We provide the best after-sales customer service to our customers to make them feel that we do care about their possession and provide them with the best solutions for their problems. </p><h2>The Brand That Cares For You</h2><p> This is ETECH! A brand that is truly concerned about its customers and loyally provides all the needs of the customers. Customers come first to this Company. Our customers will receive the best service and deals that ETECH offers. To us, our customer’s wants and needs take the top priority. We always have and will aim to provide the perfect result to our loyal customers. And our after-sales service will ensure that no one of our customers will come to us with the same issue twice. Come and experience the service, product, and facilities ETECH offers. </p></div>
        HTML;
    }
    public function return_and_exchange()
    {
        return <<<HTML
             <div class="container"><h1 class="content_title">returns &amp; exchanges</h1><ol><li>If a customer is buying the products from our shops, then please make sure to check the products in front of our sellers. Later, if any problems occur then the customer will not be entitled to any changes but will be given services based on the product provided a description (Warranty).</li><li>In the case of ordering online, after receiving the product, if any manufacturing issues or problems are noticed or discovered then the customer has to inform us within 24 hours via our hotline service. However, the product must not be scratched and the product box must be intact otherwise it won't be returnable.</li><li>After receiving the online order product from the delivery man, if the box looks like it is not the product you ordered, then please do not open or damage the box. If you open the box and use the product and destroy the box, the product will not be returnable.</li><li>If a customer received a manufacturing defective product then the customer has to visit any of our shops where our specialists will review the product first and then take the necessary steps to change the product if it is in need of replacement.</li><li>If a customer wants to change the defective product through our delivery service, then a charge of TK. 200/- has to be paid as a replacement charge inside Dhaka and if out of Dhaka, only the Courier charge is applicable.</li><li>If a Customer is buying any product from our Website after reading the description and provided information about the particular product and is received successfully without any faults and later if the product is not compatible with your setup or if you do not want it anymore, then you will not be allowed to change or return the product.</li><li>After purchasing a software/software license, a return or refund won't be applicable.</li><li>With specific reasoning, product(s) will be allowed to be returned and refunded back to you within 3 to 10 working days and in the case of online purchase, the procedure may take longer to execute.</li><li>Refund charges are applicable for All kinds of Mobile Financial Services/ Online Gateway / POS payment refunds.</li><li>If customers found broken or packet-damaged products then we are requesting not to receive the product from the courier service. If the customer receives courier damaged product then he/she has to take his/her own liability and any kind of complaint won't be acceptable.</li><li>If the honorable customer gets any cashback at the time of payment, the cashback amount will be deducted while making the refund.</li></ol><p>In order to resolve a complaint regarding the Services or to receive further information regarding use of the Services, you may email us at support@etek.com.bd or by post to:</p><address> Etek<br> Computer City Centre (Multiplan),<br> 69/71 New Elephant Road,<br> Dhaka-1205, Bangladesh </address></div>
        HTML;
    }
    public function terms_and_condition()
    {
        return <<<HTML
        <div><p>These Terms and Conditions shall remain in full force and effect while you use the Site or Services or are otherwise a user of the Site, as applicable. You may terminate your use or participation at any time, for any reason, by following the instructions for terminating user accounts in your account settings, if available, or by contacting us at support@etek.com.bd.</p><p>Price, specifications and terms of offers are subject to change without any prior notice.</p><p>Etek is not responsible for typographical and/or photographically errors. Retail products are accompanied by the original manufacturer warranty. Etek does not offer any technical support or sales advice. All the images shown in our website are either digitally enhanced or taken from different websites. Products color, size and texture may differ from what it is shown in the website. Your order might have voided without informing you.</p><h2>Payment Terms</h2><p>It is highly recommended to make sure the stock availability before making any payment. Online payment will be received through SSLCOMMERZ digital payment gateway. Additional gateway charges will be applicable with online payment. If any payment needs to be refunded it may take 10-15 working days and it may even cost you additional charges, additional fees that is deducted during the payment will not be refunded in refund request. All payment terms and rights will be reserved by SSLCOMMERZ. Please read carefully the PAYMENT TERMS in detail before making any transaction. Also read EMI Terms, Refund &amp; Return Policy.</p><h2>Processing Time</h2><p>You can expect your order to be processed within approximately 48-72 hours, provided the items are in stock and there are no problems with payment verification. Although Etek does not guarantee same day-shipping we shall strive to do so wherever possible. Orders are not processed on weekends and holidays. Also read Delivery Terms.</p><h2>Product Listing</h2><p>Etek strives for accuracy in all item descriptions, photographs, compatibility references, detailed specifications, pricing, links and any other product-related information contained herein or referenced on our website. Due to human error and other determinate we cannot guarantee that all item descriptions, photographs, compatibility references, detailed specifications, pricing, links and any other product-related information listed is entirely accurate, complete or current, nor can we assume responsibility for these errors.</p><p>In the event a product listed on our website is labeled with an incorrect price due to some typographical, informational, technical or other error, Etek shall at its sole discretion have the right to refuse and/or cancel any order for said product and immediately amend, correct and/or remove the inaccurate information. Additionally, all hyperlinks to other websites from Etek are provided as resources to customers looking for additional information and/or professional opinion. Etek does not assume responsibility for the claims and/or representations made on these or any other websites.</p><h2>RMA Claim</h2><p>Customer needs to provide proof of purchase (invoice, money receipt) to claim warranty. Customer will pay return shipping charges for all warranty services. Etek reserves the right to refuse service to anyone. Etek cannot guarantee the compatibility of items. Please contact the manufacturer(s) directly if you have issues or concerns regarding compatibility. To know more about refund, return and dead on arrival go to Return &amp; Refund Policy.</p><h2>Physical Damage Policy</h2><p>Physical damage to any product purchased from Etek will effectively void warranty coverage. Improper Installation, physical damage, burn case, removed or tempered stickers, damage caused by liquid or mishandling any product will void the warranty. As a result, Etek will return any physically damaged Products back to the customer at the customer’s expense.</p><h2>Warranties: All Products Sold With Manufacturer Warranty Only</h2><p>Etek is a retailer only. Products sold by Etek are not manufactured by Etek. Products may, however, be covered by each manufacturer’s warranty, service, and support policy (if present). Etek assigns and passes through to the customer any warranty of the manufacturer, and customer acknowledges that it shall have recourse only under such warranties and only as against the manufacturer of the products. Etek makes no representation or express warranty with respect to the product except those stated in this document. Etek disclaims all other warranties, express or implied, as to any such product, including and without limitation, the implied warranties of merchant ability and fitness for a particular purpose, and any implied warranties arising from statute, trade usage, course of dealing, or course of performance.</p><p>All items sold through Etek are sold in an “as-is” is condition i.e, as per manufacturers packing etc. The quality and performance of the product is dependent on the manufacturer. Should any of these items prove defective, do not function or function improperly in any way following their purchase Etek shall get the product repaired/serviced by the manufacturer. The buyer shall bear the cost of shipping the product to Etek.</p><p>In order to resolve a complaint regarding the Services or to receive further information regarding use of the Services, you may email us at support@etek.com.bd or by post to:</p><address> Etek<br> Shop-2347-110, Level-113, Computer City Centre (Multiplan),<br> 69/71 New Elephant Road,<br> Dhaka-1205, Bangladesh </address></div>
        HTML;
    }
    public function shiping_and_delivery()
    {
        return <<<HTML
        <div class="container"><h1 class="content_title">Shipping &amp; Delivery Policy</h1><h2>1. Shipping Methods:</h2><p>We offer nationwide shipping across Bangladesh using trusted courier services.</p><h2>2. Processing Time:</h2><p>Orders are processed within 48-72 hours after payment verification, provided the items are in stock. We do not process orders on weekends and public holidays.</p><h2>3. Shipping Rates:</h2><p>Shipping charges are calculated based on the weight and dimensions of your order. The rates will be displayed at checkout.</p><h2>4. Delivery Time:</h2><p class="m-0">Delivery times vary depending on your location:</p><ul><li><strong>Within Dhaka:</strong> 2-3 business days</li><li><strong>Outside Dhaka:</strong> 5-7 business days</li></ul><h2>5. Tracking Orders:</h2><p>Once your order has been shipped, you will receive a tracking number via email or SMS to track your package's progress.</p><h2>6. Shipping Restrictions:</h2><p>We currently do not ship internationally. For deliveries to remote areas, additional shipping charges may apply.</p><h2>7. Delivery Inspection:</h2><p>Upon delivery, please inspect your package for any damage or defects. If you notice any issues, please contact us within 24 hours of receiving your order.</p><h2>8. Missed Deliveries:</h2><p>If you miss your delivery, our courier partner will make multiple attempts to deliver your package. Please ensure someone is available to receive the package during the estimated delivery window.</p><h2>9. Delivery Address:</h2><p>Please provide a correct and complete delivery address. We will not be responsible for lost or undelivered packages due to incorrect address information provided by the customer.</p><h2>10. Contact Us:</h2><p>If you have any questions about our Shipping &amp; Delivery policy, please contact us at <a href="mailto:ctgcomputer.org@gmail.com">ctgcomputer.org@gmail.com</a> or visit our physical store at:</p><address> Etek<br> Shop-407-409, Level-04, Computer City Centre (Multiplan),<br> 69/71 New Elephant Road,<br> Dhaka-1205, Bangladesh </address></div>
        HTML;
    }
    public function coockies_policy()
    {
        return <<<HTML
        <div class="product_info_content mb-2" id="product_info_content"><div class="product_d_inner"><h1>Best Computer, Laptop, Gaming PC, PC Components, Retail &amp; Wholesale Online Shop in Bangladesh </h1><h2>Best Desktop PC Shop in Bangladesh</h2><p> ETEK BD is the Best<a href="https://www.etek.com.bd/desktop-pc"> Desktop PC</a> Shop in Bangladesh, providing the best quality PCs at the most competitive prices. With 21 years of PC building experience, you can be sure that the PCs here are reliable, powerful, and cost-effective. Our knowledgeable executives are always on hand to offer expert advice and support, ensuring that you’re getting the best value for your money. Whether you’re a casual user or a professional in need of a powerhouse machine, ETEK BD is The Best Desktop PC Shop in Bangladesh is the perfect destination for all your PC needs. </p><h2>Best Gaming PC Shop in Bangladesh</h2><p> If you're looking for the best <a href="https://www.etek.com.bd/gaming-pc">gaming PC </a>shop in Bangladesh, then you've come to the right place! At our store, we offer a wide selection of gaming PCs that are perfect for any type of gaming experience. Our knowledgeable staff is always here to answer any questions you may have, and help you find the perfect gaming PC that fits both your budget and gaming needs. <a href="https://www.etek.com.bd/direction">Visit us today</a> and experience the best gaming PC shop in Bangladesh. </p><h2>Best Office PC Shop in Bangladesh</h2><p> If you're looking for the best<a href="https://www.etek.com.bd/binary-pc"> office PC </a>shop in Bangladesh, then you've come to the right place. At ETEK BD, we provide the best quality laptops, desktops, and accessories to get your office up and running with ease. We offer attractive prices, reliable service, and prompt delivery. Our friendly staff is always ready to answer any questions you have and provide you with helpful advice. So, come on down and see for yourself why ETEK BD is the best office PC shop in Bangladesh. </p><h2>Best Graphics PC Shop in Bangladesh</h2><p> Welcome to the best <a href="https://www.etek.com.bd/graphic-pc">graphics PC shop in Bangladesh</a> at ETEK BD! Here, we make your dreams come true by providing only the best high-end components and the latest technologies. Our PCs are designed with cutting-edge graphics and performance in mind, so you can experience maximum immersion and power for the latest graphics design. Plus, our expertise in PC building lets you <a href="https://www.etek.com.bd/tools/pc_builder"> customize your PC </a>to meet your exact needs. Get ready to take your graphics designing experience to the next level at ETEK BD. </p><h2>Best &nbsp;Video Editing PC Shop in Bangladesh</h2><p> ETEK BD specializes in helping customers build their ideal <a href="https://www.etek.com.bd/graphic-pc">video editing PC</a>. Our knowledgeable and experienced staff will provide you with personalized recommendations for each component to ensure your PC meets the specific needs of your video editing workflow. We’ll help you build a powerful, reliable system that is designed to allow you to produce professional-quality videos quickly and efficiently. With our Build Your Video Editing PC, we guarantee that you’ll get the best possible value for your money and be able to edit videos with ease. </p><h2>Best Server PC Shop in Bangladesh. Build Your Server PC at ETEK BD.</h2><p> ETEK BD is the premier shop for<a href="https://www.etek.com.bd/tools/pc_builder"> building your server PC in Bangladesh</a>. With top-of-the-line components from leading brands, custom PC building services, and knowledgeable, friendly staff, ETEK BD is the best choice for constructing your server PC. All of the components are top-notch and tested to ensure the highest quality performance for your server, and the staff can assist with any questions or concerns you may have. With the combination of quality hardware and superior customer service, ETEK BD is the premier shop for building your <a href="https://www.etek.com.bd/server">server PC</a>.<br> &nbsp; </p><h2>Best PC case shop at an affordable price&nbsp;in Bangladesh</h2><p> We are the best PC case shop in Bangladesh because we provide good quality products at an affordable price. Our products are made from durable materials and are designed to protect your computers from damage. We also offer a wide variety of styles and colors to choose from <a href="https://www.etek.com.bd/darkflash">darkflash </a>&amp; <a href="https://www.etek.com.bd/cooler-master">Cooler Master</a>, so you can find the perfect <a href="https://www.etek.com.bd/case">pc case </a>for your needs. </p><h2>Best Computer Motherboard shop at an affordable price in Bangladesh</h2><p> Need a new <a href="https://www.etek.com.bd/motherboard">computer motherboard</a> but don't want to spend a fortune? Check out our list of the best computer motherboards for an affordable price in Bangladesh. We've got options for every budget, so you can find the perfect motherboard for your needs. Whether you're looking for a high-end option for gaming or a budget-friendly option for work, we've got you covered.&nbsp; </p><p>No matter what your needs are, we're sure you'll <a href="https://www.etek.com.bd/motherboard">find</a> the perfect computer motherboard on our website.</p><h2>Best &nbsp;Graphics Card shop at an affordable price in Bangladesh&nbsp;</h2><p> If you're looking for the best graphics card shop at an affordable price in Bangladesh, then you've come to the right place. We offer a wide range of graphics cards from leading brands, all at great prices. Our selection includes cards for both desktops and laptops, so you're sure to find the perfect card for your needs. And if you're not sure which card is right for you, our friendly and knowledgeable staff will be happy to help you choose the perfect card for your budget and needs. </p><p>So come and visit us today, and see for yourself why we're the best place to buy <a href="https://www.etek.com.bd/graphics-card">graphics cards</a> in Bangladesh.</p><h2>Best POS Printer shop at an affordable price in Bangladesh</h2><p> Are you looking for a POS printer shop in Bangladesh? Look no further than Printer Point. We offer the best <a href="https://www.etek.com.bd/pos-printer">POS printers</a> at an affordable price. Our printers are known for their quality and durability. We have a wide range of printers to choose from, so you can find the perfect one for your needs. </p><h2>Best Barcode Printer &amp; Scanner shop at an affordable price in Bangladesh</h2><p> In this fast-paced world, a barcode printer &amp; scanner is a must-have for any business. At our shop, we offer the best barcode printer &amp; scanner at an affordable price in Bangladesh. We have a wide range of barcode printers &amp; scanners to choose from, so you can find the perfect one for your business. We also offer a wide range of accessories, so you can get everything you need to get started. </p><h2>Best Computer Monitor shop at an affordable price in Bangladesh</h2><p> We are the best <a href="https://www.etek.com.bd/monitor">computer monito</a>r shop at an affordable price in Bangladesh. With years of experience in the industry, we provide top-quality products and services to our customers. Our <strong>monitors</strong> are perfect for <a href="https://www.etek.com.bd/hp">gaming</a>, <a href="https://www.etek.com.bd/asus-monitor-price">video editing</a>, and graphic design. We also offer a wide variety of other<a href="https://www.etek.com.bd/peripheral"> computer accessories</a>. Shop now. </p></div></div>
        HTML;
    }
}
