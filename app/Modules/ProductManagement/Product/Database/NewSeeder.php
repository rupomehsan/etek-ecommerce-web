<?php

namespace App\Modules\ProductManagement\Product\Database;

use Carbon\Carbon;
use Illuminate\Database\Seeder as SeederClass;
use  App\Modules\ProductManagement\Product\Models\Model as ProductModel;
use App\Modules\ProductManagement\Product\Models\ProductImageModel as ProductImage;
use App\Modules\ProductManagement\ProductCategoryGroup\Models\Model as CategoryGroupModel;
use App\Modules\ProductManagement\ProductCategory\Models\Model as SubCategoryModel;
use App\Modules\ProductManagement\ProductVarientGroup\Models\Model as ProductVarientGroup;
use App\Modules\ProductManagement\ProductVarient\Models\Model as ProductVarient;
use App\Modules\ProductManagement\ProductVarientValue\Models\Model as ProductVarientValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewSeeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\Product\Database\NewSeeder"
     */
    static $model = \App\Modules\ProductManagement\Product\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        CategoryGroupModel::truncate();
        SubCategoryModel::truncate();
        ProductVarientGroup::truncate();
        ProductVarient::truncate();
        ProductVarientValue::truncate();
        DB::table('product_varient_prices')->truncate();
        DB::table('product_images')->truncate();
        DB::table('product_category_products')->truncate();


        $products =
            [
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/11/1000288133-300x300.jpg",
                    "title" => "Essential Fear Of God Men’s Trouser With Original Packaging.",
                    "regular_price" => "2350.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/02/1000092884-300x300.jpg",
                    "title" => "Essential Flocking Lettered Logo Oversized Shots High Street Hip Top Men’s & Women’s (Unisex) Cotton Shorts.",
                    "regular_price" => "1890.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/02/1000092863-300x300.jpg",
                    "title" => "Essential Flocking Lettered Logo Oversized Shots High Street Hip Top Men’s Cotton Shorts.",
                    "regular_price" => "1890.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/11/13200-300x300.jpg",
                    "title" => "Giordano Men’s Original Trouser.",
                    "regular_price" => "2890.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/11/1000276593-300x300.jpg",
                    "title" => "Jordan Men’s Original Trouser .",
                    "regular_price" => "2050.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171087-300x300.jpg",
                    "title" => "Men’s Casual Formal Pant.",
                    "regular_price" => "2350.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171092-300x300.jpg",
                    "title" => "Men’s Casual Formal Pant.",
                    "regular_price" => "2150.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171105-300x300.jpg",
                    "title" => "Men’s Linen Pant.",
                    "regular_price" => "2350.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000375221-300x300.jpg",
                    "title" => "Men’s Linen Pant.",
                    "regular_price" => "2050.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000375510-300x300.jpg",
                    "title" => "Men’s Original Pant.",
                    "regular_price" => "2890.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000375513-300x300.jpg",
                    "title" => "Men’s Original Casual Pant.",
                    "regular_price" => "2890.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000375225-300x300.jpg",
                    "title" => "Men’s Original Formal Pant.",
                    "regular_price" => "2150.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000375522-300x300.jpg",
                    "title" => "Men’s Original Linen Pant.",
                    "regular_price" => "2350.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000375519-300x300.jpg",
                    "title" => "Men’s Original Linen Pant.",
                    "regular_price" => "2850.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000375516-300x300.jpg",
                    "title" => "Men’s Original Linen Pant.",
                    "regular_price" => "2850.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000374967-300x300.jpg",
                    "title" => "men’s Original Trouser.",
                    "regular_price" => "2150.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000374973-300x300.jpg",
                    "title" => "Men’s Original Trouser.",
                    "regular_price" => "2150.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/10/1000268381-300x300.jpg",
                    "title" => "Nike – Air Jordan Trouser .",
                    "regular_price" => "2200.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/09/tarak_himu121_91d0b4638ccf4b0b96b49fe2d0e83537-300x300.jpg",
                    "title" => "Nike Men’s Trouser.",
                    "regular_price" => "1800.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/11/1000025798-300x300.jpg",
                    "title" => "Nike Original Men’s Trouser.",
                    "regular_price" => "2350.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/10/1000269633-300x300.jpg",
                    "title" => "Tommy Hilfiger Men’s Original Hoddie Trouser Two Pics Set.",
                    "regular_price" => "5299.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2023/11/1000276580-300x300.jpg",
                    "title" => "True Religion Men’s 100% Authentic Trouser.",
                    "regular_price" => "2199.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000174321-300x300.jpg",
                    "title" => "Zara Linen Pant.",
                    "regular_price" => "2650.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000170471-300x300.jpg",
                    "title" => "Zara Men’s Casual Pant.",
                    "regular_price" => "3290.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171611-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171635-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171629-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3890.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171628-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3890.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171627-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171626-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171604-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171605-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171607-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171606-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171608-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/Ins_1644137692-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171610-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171625-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171612-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171613-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171617-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171618-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171623-1-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171619-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171621-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171620-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171622-2-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171622-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171623-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ],
                [
                    "image" => "https://fashionproductsbd.com/wp-content/uploads/2024/06/1000171624-300x300.jpg",
                    "title" => "Zara Men’s Polo Shirt Two Pics Set.",
                    "regular_price" => "3690.00"
                ]

            ];


        $categoryGroups = [
            [
                "category_group_title" => "Men Fashion",
                "sub_categories" => [
                    "Men’s Pant",
                    "Men’s Casual Pant",
                    "Men’s Denim Pant",
                    "Men’s Belt",
                    "Men’s Hand Watch",
                    "Men’s Jewellery",
                    "Men’s Shirt",
                    "Men’s Polo Shirt",
                    "Men’s T-Shirt",
                    "Men’s Casual Shoes",
                    "Men’s Sneakers",
                    "Men’s Sliders",
                    "Men’s Sunglasses"
                ]
            ],
            [
                "category_group_title" => "Women Fashion",
                "sub_categories" => [
                    "Women’s Pant",
                    "Women’s Casual Pant",
                    "Women’s Denim Pant",
                    "Women’s Hand Watch",
                    "Women’s Jewellery",
                    "Women’s Shirt",
                    "Women’s Polo Shirt",
                    "Women’s T-Shirt",
                    "Women’s Casual Shoes",
                    "Women’s Sneakers",
                    "Women’s Sliders",
                    "Women’s Sunglasses"
                ]
            ],
        ];

        // Variant Group, Variants, and Values
        $variantGroups = [
            "Clothing" => [
                "Color" => ["Red", "Blue", "Green", "Black"],
                "Size" => ["M", "L", "XL"],
            ],
        ];

        // Insert Category Groups and Subcategories
        foreach ($categoryGroups as $groupData) {
            $categoryGroup = CategoryGroupModel::create([
                "title" => $groupData['category_group_title'],
            ]);

            $subCategories = array_map(function ($sub) use ($categoryGroup) {
                return [
                    "title" => $sub,
                    "slug" => Str::slug($sub) . '-' . $categoryGroup->id,
                    "product_category_group_id" => $categoryGroup->id,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ];
            }, $groupData['sub_categories']);

            SubCategoryModel::insert($subCategories);
        }

        // Insert Variant Groups, Variants, and Values
        foreach ($variantGroups as $groupTitle => $variants) {
            $varientGroup = ProductVarientGroup::create(["title" => $groupTitle]);

            foreach ($variants as $variantTitle => $values) {
                $variant = ProductVarient::create([
                    "title" => $variantTitle,
                    "product_varient_group_id" => $varientGroup->id,
                ]);

                $varientValues = array_map(function ($value) use ($variant) {
                    return [
                        "title" => $value,
                        "product_varient_id" => $variant->id,
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ];
                }, $values);

                ProductVarientValue::insert($varientValues);
            }
        }

        // Insert Products and their Images and Variant Prices
        foreach ($products as $item) {
            $product = ProductModel::create([
                "title" => $item['title'],
                "is_featured" => 1,
                "type" => 'fashion',
                "purchase_price" => $item['regular_price'],
                "customer_sales_price" => $item['regular_price'],
                "retailer_sales_price" => $item['regular_price'],
            ]);

            ProductImage::create([
                "url" => $item['image'],
                "product_id" => $product->id,
            ]);

            // Insert product variant prices
            DB::table('product_varient_prices')->insert([
                'product_id' => $product->id,
                'product_varient_group_id' => 1, // Assuming 1 corresponds to 'Clothing'
                'product_varient_id' => 1,      // Assuming 1 corresponds to 'Color'
                'price' => $item['regular_price'],
            ]);
            // Insert product variant prices
            DB::table('product_category_products')->insert([
                'product_id' => $product->id,
                'product_category_id' => rand(1, 25), // Assuming 1 corresponds to 'Clothing'
                'product_category_group_id' => rand(1, 2),      // Assuming 1 corresponds to 'Color'
            ]);
        }
    }
}
