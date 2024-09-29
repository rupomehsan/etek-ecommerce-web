<?php

namespace App\Modules\ProductManagement\Product\Database;

use Carbon\Carbon;
use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\Product\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\Product\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();




        $data =  [
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/a/tang_orange_flavoured_instant_drink_powder_jar_2kg_1.jpg",
                "title" => "Tang Orange Flavoured Instant Drink Powder Jar, 2K",
                "regular_price" => "৳ 1700",
                "del_price" => "৳1850"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/r/u/rup-chada-5-lit.jpg",
                "title" => "Rupchanda Soyabean Oil, PET Bottle, 5 Liter",
                "regular_price" => "৳ 818",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/a/tang_jar_orange_flavor_750gm_1.jpg",
                "title" => "Tang Jar Orange Flavor, 750gm",
                "regular_price" => "৳ 710",
                "del_price" => "৳760"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/b/o/borges_sunflower_oil_5_ltr.jpg",
                "title" => "Borges Sunflower Oil, 5 Liter",
                "regular_price" => "৳ 2170",
                "del_price" => "৳2450"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/f/g/fgrf0200027g500.jpg",
                "title" => "Fortune Chana Besan, 500gm",
                "regular_price" => "৳ 105",
                "del_price" => "৳110"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/e/g/eggy-inastent-noodles-_masala_-720gm-gift-basket-free-2.jpg",
                "title" => "Ifad Eggy Instant Noodles Masala, 720gm (Gift Bask",
                "regular_price" => "৳ 240",
                "del_price" => "৳260"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/_/0/_0009_gemb0100003g250.jpg",
                "title" => "Marks Milk Powder, 250gm",
                "regular_price" => "৳ 218",
                "del_price" => "৳225"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/n/e/nestle-nido-fortigrow-full-cream-milk-powder-_tin_-1kg.jpg",
                "title" => "Nestle Nido Fortigrow Full Cream Milk Powder (Tin)",
                "regular_price" => "৳ 1350",
                "del_price" => "৳1400"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/e/1/e19ecd82-35be-4ed3-8312-8d68130a6376_2.jpg",
                "title" => "Pusti Family Blend Tea, 200gm",
                "regular_price" => "৳ 75",
                "del_price" => "৳100"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/f/g/fgog0100102l250.jpg",
                "title" => "Pusti Mustard Oil, 250ml",
                "regular_price" => "৳ 70",
                "del_price" => "৳90"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/b/e/benco_s1_pro_gemstone_black.jpg",
                "title" => "Benco S1 Pro, RAM 6GB, ROM 128GB, Gemstone Black",
                "regular_price" => "৳ 14990",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/h/o/honor_pad_x9.jpg",
                "title" => "HONOR Pad X9, RAM 4GB, ROM 128GB",
                "regular_price" => "৳ 22999",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/h/o/honor-x7a_combine.jpg",
                "title" => "HONOR X7a, RAM 6GB, ROM 128GB",
                "regular_price" => "৳ 19999",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/i/n/infinix_hot_30.jpg",
                "title" => "Infinix Hot 30, ROM 128GB",
                "regular_price" => "৳ 13424",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/1/5/15_16_1.jpg",
                "title" => "iPhone 15 Pro",
                "regular_price" => "৳ 179999",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/c/5/c55-6--128.jpg",
                "title" => "Realme C55, RAM 6GB, ROM 128GB, Sunshower",
                "regular_price" => "৳ 19749",
                "del_price" => "৳19999"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/a/samsung-galaxy-a04--ram-3gb-32gb.jpg",
                "title" => "Samsung Galaxy A04, RAM 3GB, ROM 32GB",
                "regular_price" => "৳ 14990",
                "del_price" => "৳15999"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/m/p/mpmp01001460ppp.jpg",
                "title" => "Symphony Z70, RAM 4GB, ROM 64GB",
                "regular_price" => "৳ 9499",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/e/tecnospark10c_combine.jpg",
                "title" => "Tecno Spark 10C, 128GB",
                "regular_price" => "৳ 12411",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/w/h/whatsapp_image_2023-08-03_at_12.20.13_pm_1_2.jpeg",
                "title" => "VIVO Y02A, RAM 3GB, ROM 32GB",
                "regular_price" => "৳ 11290",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/b/e/beautina_body_lotion_aloe_vera_cocoa_butter_200ml_with_free_sandalina_soap_75gm_.jpg",
                "title" => "Beautina Body Lotion Aloe Vera & Cocoa Butter, 200",
                "regular_price" => "৳ 172",
                "del_price" => "৳200"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/1/_/1_1_-1_1.jpg",
                "title" => "Colgate Visible White Toothpaste, 200gm",
                "regular_price" => "৳ 475",
                "del_price" => "৳490"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/_/0/_0029_whatsapp_image_2022-12-20_at_5.38.38_pm_1.jpg",
                "title" => "Dettol Soap Aloe Vera, 75gm",
                "regular_price" => "৳ 55",
                "del_price" => "৳60"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/f/g/fgsg0200002g195.jpg",
                "title" => "Gillette Fusion Proglide Cooling Shave Gel, 195gm",
                "regular_price" => "৳ 665",
                "del_price" => "৳725"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/1/5/15_0016_head_shoulders_lemon_fresh_anti_dandruff_shampoo_180_ml_1.jpg",
                "title" => "Head & Shoulders Anti Dandruff Shampoo, 180ml, Lem",
                "regular_price" => "৳ 282",
                "del_price" => "৳315"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/w/h/whatsapp_image_2024-01-17_at_17.44.09_e0942943.jpg",
                "title" => "Listerine Mouth Wash Advanced White, 500ml (Import",
                "regular_price" => "৳ 750",
                "del_price" => "৳1095"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/p/b/pbpc0400136l400.jpg",
                "title" => "Nivea Body Lotion Irresistibly Smooth, 400ml",
                "regular_price" => "৳ 910",
                "del_price" => "৳990"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/i/simple_kind_to_skin_hydrating_light_moisturizer_125ml.jpg",
                "title" => "Simple Kind to Skin Hydrating Light Moisturizer, 1",
                "regular_price" => "৳ 650",
                "del_price" => "৳700"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/p/b/pbpc0300037l175.jpg",
                "title" => "Studio X Anti Dandruff Shampoo for Men, 175ml",
                "regular_price" => "৳ 247",
                "del_price" => "৳260"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/h/b/hbpc0300212l180.jpg",
                "title" => "Sunsilk Shampoo Lusciously Thick & Long, 170ml",
                "regular_price" => "৳ 230",
                "del_price" => "৳280"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/f/l/flormar_silk_matte_liquid_lipstick_007_claret_red_1.jpg",
                "title" => "Flormar Silk Matte Liquid Lipstick, 007 Claret Red",
                "regular_price" => "৳ 1070",
                "del_price" => "৳1240"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/6/3/63_3.jpg",
                "title" => "Lilac 10% Vitamin C Serum, 30ml",
                "regular_price" => "৳ 674",
                "del_price" => "৳800"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/m/a/maybelline_instant_anti-age_eraser_concealer-buff-08.jpg",
                "title" => "Maybelline Instant Anti-Age Eraser Concealer, 08 B",
                "regular_price" => "৳ 900",
                "del_price" => "৳1450"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/7/b/7b05ca6b-7736-4936-9c6d-6e1eef525b7f.jpg",
                "title" => "Nirvana Color Nail Enamel, Cherry Picked- 14, 8ml",
                "regular_price" => "৳ 151",
                "del_price" => "৳180"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/r/i/ribana_coconut_oil_200ml.jpg",
                "title" => "RiBANA Coconut Oil, 200ml",
                "regular_price" => "৳ 340",
                "del_price" => "৳400"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/e/technic_banana_bright_loose_powder_10gm.jpg",
                "title" => "Technic Banana Bright Loose Powder, 10gm",
                "regular_price" => "৳ 380",
                "del_price" => "৳550"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/e/technic_blush_palette_warm_edit_20gm.jpg",
                "title" => "Technic Blush Palette, Warm Edit, 20gm",
                "regular_price" => "৳ 480",
                "del_price" => "৳650"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/e/technic_mega_glow_highlighter_palette_10gm.jpg",
                "title" => "Technic Mega Glow Highlighter Palette, 10gm",
                "regular_price" => "৳ 285",
                "del_price" => "৳500"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/e/technic_mega_matte_blush_11.2gm.jpg",
                "title" => "Technic Mega Matte Blush, 11.2gm",
                "regular_price" => "৳ 285",
                "del_price" => "৳500"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/e/technic_mega_matte_bronzer_palette_10gm.jpg",
                "title" => "Technic Mega Matte Bronzer Palette, 10gm",
                "regular_price" => "৳ 300",
                "del_price" => "৳500"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/0/5/05_7_1.jpg",
                "title" => "Danaaz Android 9.0 UHD Smart LED TV DZLE-50AS21X,",
                "regular_price" => "৳ 40890",
                "del_price" => "৳59900"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/h/4/h43k800fx-11-26-23.jpg",
                "title" => "Haier 43 Inch Bezel Less FHD Google TV (H43K800FX)",
                "regular_price" => "৳ 31990",
                "del_price" => "৳42900"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/5/0/50cu7700_1__1.jpg",
                "title" => "Samsung 50 Inch Crystal UHD 4K Smart TV (50CU7700)",
                "regular_price" => "৳ 63730",
                "del_price" => "৳82900"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/a/samsung_43bu8000_3.jpg",
                "title" => "Samsung Crystal UHD 4K Smart TV, 43 Inches (43BU80",
                "regular_price" => "৳ 48295",
                "del_price" => "৳70900"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/i/singer_32_inches_frame_less_android_tv_sle32d6100gotv_1.jpg",
                "title" => "SINGER 32 Inches Frame Less Android TV (SLE32D6100",
                "regular_price" => "৳ 23990",
                "del_price" => "৳25990"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/i/singer_32_inches_frame_less_android_tv_sle32e3agotv_1.jpg",
                "title" => "Singer 32 Inches Frame Less Android TV (SLE32E3AGO",
                "regular_price" => "৳ 23490",
                "del_price" => "৳24990"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/i/singer_43_inches_frame_less_fhd_smart_android_tv_sle43a5000gotv_2.jpg",
                "title" => "Singer 43 Inches Frame Less FHD Smart Android TV (",
                "regular_price" => "৳ 35490",
                "del_price" => "৳38490"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/i/singer_50_inches_frame_less_4k_google_tv_sle50g22gotv_1.jpg",
                "title" => "Singer 50 Inches Frame Less 4K Google TV (SLE50G22",
                "regular_price" => "৳ 53490",
                "del_price" => "৳60990"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/i/singer_43_inches_frame_less_fhd_smart_android_tv_sle43a5000gotv_2_1.jpg",
                "title" => "Singer Primax 43 Inches Frame Less 4K Smart Androi",
                "regular_price" => "৳ 43490",
                "del_price" => "৳46990"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/4/3/43c350kp_1__1.jpg",
                "title" => "Toshiba 43 Inch UHD 4K Smart TV (43C350KP)",
                "regular_price" => "৳ 46391",
                "del_price" => "৳52900"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/2/8/28_6_1.jpg",
                "title" => "Bottle & Nipple Liquid Cleanser, 500ml (2401)",
                "regular_price" => "৳ 608",
                "del_price" => "৳1000"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/1/_/1_93.jpg",
                "title" => "Johnson's Baby Lotion Milk and Rice, 100gm",
                "regular_price" => "৳ 245",
                "del_price" => "৳260"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/1/_/1_79.jpg",
                "title" => "Johnson's Baby Milk and Rice Cream, 100gm",
                "regular_price" => "৳ 312",
                "del_price" => "৳322"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/p/c/pcci0700084l100.jpg",
                "title" => "Meril Baby Lotion, 100ml",
                "regular_price" => "৳ 165",
                "del_price" => "৳180"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/w/h/whatsapp_image_2024-03-10_at_12.47.14_pm.jpeg",
                "title" => "Nestle Cerelac 1 Rice With Milk Baby Food (6 M), 3",
                "regular_price" => "৳ 400",
                "del_price" => 0
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/_/0/_0010_26_1_1.jpg",
                "title" => "Nestle Cerelac 4 Apple Corn Flakes (12 M+), 350gm",
                "regular_price" => "৳ 460",
                "del_price" => "৳470"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/p/c/pcbc02000160p50.jpg",
                "title" => "Pampers Diapers Pants, M Size, (7-12 KG) 50 Pieces",
                "regular_price" => "৳ 1420",
                "del_price" => "৳1870"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/5/0/50.1_2.jpg",
                "title" => "PUR Glass Feeding Bottle 2oz./60ml (1201)",
                "regular_price" => "৳ 740",
                "del_price" => "৳1000"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/s/m/smartcare-bottle-brush-straight-in-white-background_1.jpg",
                "title" => "Smart Care Bottle Brush Set",
                "regular_price" => "৳ 184",
                "del_price" => "৳200"
            ],
            [
                "image" => "https://m2ce.sindabad.com/pub/media/catalog/product/t/w/twinkle_baby_wipes_pouch_120_pcs.jpg",
                "title" => "Twinkle Baby Wipes Pouch, Pack of 120 Pieces",
                "regular_price" => "৳ 220",
                "del_price" => "৳245"
            ]
        ];

        foreach ($data as $item) {

            $regularPrice = 0;
            $delPrice = 0;
            $discountPrice = 0;

            if ($item['regular_price'] != "") {
                $regularPrice = preg_replace('/[^0-9]/', '', $item['regular_price']);
            }

            if ($item['del_price'] != "") {
                $delPrice = preg_replace('/[^0-9]/', '', $item['del_price']);
            }

            if ($delPrice && $regularPrice) {
                $discountPrice = $delPrice - $regularPrice;
            }

            $regularPrice -= $discountPrice;


            $product = self::$model::create([
                'product_category_group_id' => 1,
                'title' => $item['title'],
                'type' => "product",
                'short_description' => $item['title'] . " are one of the most popular fruits in the world. They're full of important nutrients. It contains high amounts of vitamins C, and B, as well as magnesium, potassium, folate, and antioxidants. It also contains some fiber and protein. Can be eaten both raw and ripe. Ripe bananas are sweet. Sagor bananas are usually long in size and ripen very quickly.",
                'description' => $item['title'] . " are one of the most popular fruits in the world. They're full of important nutrients. It contains high amounts of vitamins C, and B, as well as magnesium, potassium, folate, and antioxidants. It also contains some fiber and protein. Can be eaten both raw and ripe. Ripe bananas are sweet. Sagor bananas are usually long in size and ripen very quickly.",
                'product_menufecturer_id' => rand(1, 5),
                'product_brand_id' => rand(1, 5),
                'sku' => rand(10000, 99999),
                'product_unit_id' => rand(1, 5),
                'alert_quantity' => 10,
                'seller_points' => rand(2, 5),
                'is_returnable' => rand(0, 1),
                'expiration_days' => Carbon::now()->addMonths(30)->toDateString(),
                // 'purchase_account' => facker()->name,

                'discount_type' => "flat",
                'discount_amount' => $discountPrice,

                'price_type' => "single",

                'purchase_price' => $regularPrice - 30,

                'customer_sales_price' => $regularPrice,
                'retailer_sales_price' => $regularPrice - 5,
                'minimum_sale_price' => $regularPrice - 10,
                'maximum_sale_price' => $regularPrice + 20,

                'tax_type' => ['inclusive', 'exclusive'][rand(0, 1)],
                'tax_amount' => .5,
                'is_featured' => rand(0, 1),

            ]);


            $product->product_categories()->attach([rand(1, 5), rand(6, 9)]);

            // $imageUrl = parse_url($item['image']);
            // $imagePath = $imageUrl['path'];

            //upload image in to public/uploads/d_products

            // $image = file_get_contents($item['image']);
            // file_put_contents(public_path('uploads/d_products/' . $product->id . '.jpg'), $image);

            $product->product_images()->create([
                'url' => 'uploads/d_products/' . $product->id . '.jpg',
                'caption' => $item['title'],
                'alt' => $item['title'],
                'is_primary' => 1,
                'is_secondary' => 0,
                'is_thumb' => 0,
            ]);
        }
    }
}
