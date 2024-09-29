<?php

namespace App\Modules\ProductManagement\ProductCategory\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductCategory\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        /**

         */

        $data =
            [
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1629.jpg",
                    "title" => "চাল ও খাদ্যশস্য",
                    "subcategories" => [
                        "Rice", "Dal", 'Atta', "salt"
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2675.jpg",
                    "title" => "তেল ও ঘি",
                    "subcategories" => [
                        "Cooking oil", "Gee"
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2677.jpg",
                    "title" => "যাবতীয় মসলা",
                    "subcategories" => [
                        "Spice", "Ready mix"
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2696.jpg",
                    "title" => "ডিম ও দুগ্ধপণ্য",
                    "subcategories" => [
                        "Eggs", "Powder milk", "Condensed milk", "Butter", 'milk powder'
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2674.jpg",
                    "title" => "পানীয়",
                    "subcategories" => [
                        'Tea', 'Coffee', 'Soda', 'Water', 'Juice'
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2351.jpg",
                    "title" => "স্ন্যাকস ও বেকারি",
                    "subcategories" => [
                        'Noodles', 'Snack', 'Bakery', 'Sweet', 'Chips'
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2720.jpg",
                    "title" => "সবজি ও ফলমূল",
                    "subcategories" => [
                        "fresh", "cold"
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2872.jpg",
                    "title" => "মাংস ও মাছ",
                    "subcategories" => [
                        'Meat'
                    ]
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2876.jpg",
                    "title" => "হিমায়িত ও টিনজাত খাদ্য",
                    "subcategories" => [
                        'Frozen', 'Canned'
                    ]
                ]
            ];


        foreach ($data as $item) {

            $title = $item['title'];

            $category =  self::$model::create([
                'title' => $item['title'],
                'serial' => 0,
                'product_category_group_id' => '1',
                'parent_id' => 0,
                'is_nav' => rand(0, 1),
                'image' => $item['image'],

                'meta_title' => $title,
                'meta_description' => $title,
                'meta_keywords' => $title,
                'search_keywords' => $title,

                'page_header_title' => $title . " Price in Bangladesh (BD)",
                'page_header_description' => '<p><span style="font-weight: bold;">Desktop PC</span> Price in Bangladesh starts from BDT 25000 and depending on the configuration the price may go up to BDT 600,000 or more, At Star Tech you can get the latest configured custom Desktop PC, Gaming PC, Brand PC, All-in-One PC, Portable Mini PC etc. Browse below and Order yours now!</p>',

                'page_full_description_title' => $title . " in Bangladesh",
                'page_full_description' => '<div class="category-description p-15 ws-box">
                    <h2>Desktop PC in Bangladesh</h2>
                    <p>Welcome to Star Techs <span style="font-weight: bold;">Desktop PC</span> collection, where we house the largest collection of Desktop computers in Bangladesh! From high-end workstations to <a href="/desktops/gaming-pc" target="">Gaming PC</a> and beyond - Star Tech PC shop is the place to be. As the leading computer, tech, and networking equipment vendor in the nation, we take pride in providing the best desktop PC price. Choose from the best PC configurations for freelancing, gaming, and editing. Bringing the PC giants around the world like Asus, HP, Lenovo, and many more, buying a PC for the best price is as easy as surfing the web. We provide an extensive collection of the best desktop PC configurations with detailed price and performance insights, enabling our customers to make informed purchases. With our highly user-friendly e-commerce website and information on the most updated desktop PC price list in BD, you get a wide selection to choose from in 2024.</p><h2>Latest Desktop PC Pricelist in BD 2024</h2>
                    <table class="latest-product-list table-bordered">
                    <tbody><tr><th class="txt-left">Desktop PC List</th><th class="text-right">Price in BD</th></tr>
                    <tr class="latest-product"><td class="product-name"><a href="/lenovo-thinkcentre-neo-50t-gen-4-core-i5-13th-gen-brand-pc">Lenovo ThinkCentre Neo 50t Gen 4 Core i5 13th Gen Brand PC</a></td><td class="product-price text-right">62,500৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-thinkcentre-neo-50t-gen-4-core-i5-12th-gen-brand-pc">Lenovo ThinkCentre Neo 50t Gen 4 Core i5 12th Gen Brand PC</a></td><td class="product-price text-right">60,500৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-thinkcentre-neo-50t-gen-4-core-i3-12th-gen-brand-pc">Lenovo ThinkCentre Neo 50t Gen 4 Core i3 12th Gen Brand PC</a></td><td class="product-price text-right">50,500৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/amd-ryzen-7-7700x-gaming-desktop-pc">AMD Ryzen 7 7700X Gaming Desktop PC</a></td><td class="product-price text-right">149,999৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/intel-core-i5-11400-11th-gen-desktop-pc">Intel Core i5 11400 11th Gen Desktop PC</a></td><td class="product-price text-right">30,999৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-ideacentre-aio-3-24iap7-i7-13th-gen-all-in-one-pc">Lenovo IdeaCentre AIO 3 24IAP7 Core i7 13th Gen 16GB RAM 23.8" All-in-One Desktop PC</a></td><td class="product-price text-right">105,000৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-ideacentre-aio-3-24iap7-core-i5-13th-gen-all-in-one-pc">Lenovo IdeaCentre AIO 3 24IAP7 Core i5 13th Gen 23.8" All-in-One Desktop PC</a></td><td class="product-price text-right">95,000৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-ideacentre-aio-3-24iap7-core-i3-12th-gen-all-in-one-pc">Lenovo IdeaCentre AIO 3 24IAP7 Core i3 12th Gen 512GB SSD 23.8" All-in-One Desktop PC</a></td><td class="product-price text-right">73,000৳</td></tr>          </tbody></table>
                    <p></p><h2>Why Choose Star Tech for Buying a Desktop PC?</h2><p>Before delving into the details, let\'s explore why<a href="/desktops/gaming-pc" target=""> Star Tech </a>stands out as the preferred choice for buying desktop PCs in Bangladesh. With over a decade of experience in the tech industry, Star Tech Ltd has established itself as a reputable and reliable source for all types of computing needs. Our commitment to providing top-notch customer service, the most exciting deals and offers, along with a vast collection of the latest desktop PCs from renowned brands, has earned us the trust and loyalty of countless customers.</p><h2>Available Types of Desktop PC in BD</h2><p>At Star Tech, we house the broadest range of Desktop PC, with options from highly energy-efficient, small-form-factor PCs to extensive game-centric ones. Within the PC type spectrum, the Mid Tower form factor is the most popular type of <span style="font-weight: bold;">Desktop PC</span> in BD. Other form factors like Tower and Extended Tower PC are also favored by enthusiast users.</p><h3>Brand Desktop PC</h3><p>A <a href="/desktops/brand-pc" target="">Brand PC</a> or pre-built personal computer is a Desktop system, fully built by a manufacturer. Brand PC is highly popular as a time and energy-saving option since users don’t require taking the hassle of building a PC from scratch. Although a Brand PC may cost a little more than a custom PC of the same configuration, Brand desktop computers also come with some perks. The best one is; they have a very extended warranty, and the support service is great. There will be little or no chance to upgrade a Brand PC.</p><h4>Which Brand of PC is Most Popular in Bangladesh?</h4><p>In Bangladesh, Brand PCs became popular with the advent of broadband internet during the early 2000s. Currently, the most popular PC brands in the country are - <a href="/desktops/brand-pc/acer-desktop" target="">Acer</a>, HP, <a href="/desktops/brand-pc/lenovo-desktop" target="">Lenovo</a>, Apple, <a href="/desktops/brand-pc/asus-desktop" target="">Asus</a>, Dell, and MSI. They are widely used in office and corporate environments since they are usually compact, energy-efficient, and clutter-free.</p><h3>All-in-One PC</h3><p><a href="/desktops/all-in-one-pc" target="">All-in-One PC</a> (AIO PC) is an extremely minimalistic PC form factor in which the complete system is integrated behind the display. This way, only the slim and thin <a href="/monitor" target="">monitor</a> is visible. This is widely popular in offices and among users who prioritize a clean Desktop setup. <a href="/desktops/all-in-one-pc" target="">AIO desktop PC</a> price can be slightly higher than a standard PC with the same prowess.</p><h3>Mini PC</h3><p>Mini PC is another small factor requiring very little space. All the components are set up in a tiny chassis to allow easy movement or hide the PC completely. Brands like ZOTAC &amp; Asus are famous for making very powerful Mini PCs.<a href="/desktops/portable-mini-pc" target=""> Mini PC </a>prices are insignificant, and you can get a Mini Desktop PC at Star Tech for just over 18,000 BDT.</p><h3>Customized Desktop PC</h3><p>A ‘Custom PC’ is a type where the user handpicks all the desktop <a href="/component" target="">components </a>and then assembles them into a computer setup. A custom PC is the most popular approach for buying a desktop computer in modern times since this tier can offer budget options to extremely premium ones. At Star Tech, you can build Desktop PC on a tight budget, or you can build a high-performing custom Gaming computer as well.</p><h4>Gaming Desktop PC</h4><p>Immerse yourself in the world of <a href="/gaming" target="">gaming </a>with the highest-performance gaming desktops. Equipped with cutting-edge <a href="/component/graphics-card" target="">graphics cards </a>and powerful processors, the range of <a href="/desktops/gaming-pc" target="">Gaming Desktop PC </a>at Star Tech accumulates all the winning factors for competitive eSports sessions. Plus, the Gaming PC collection at Star Tech typically comes with ample network and peripheral connectivity options, making any heavy computing loads like gaming or graphics designing a breeze.</p><h4>Business Desktop PC</h4><p>In search of the most cost-efficient PC for your business or office? The Business Desktop PC range at Star Tech is here to lower your burdens, offering durable, stylish, and energy-efficient desktop computers. Enjoy the highest productive hours with the reliable business desktop PCs from Star Tech, designed to handle demanding office tasks for years to come.</p><h4>Home Entertainment PC</h4><p>Revamped home entertainment is the sole purpose of Home PCs. Every home PC built at Star Tech is optimized for the richest multimedia experience with immersive sound and visuals. A Home Entertainment PC is your way to go if you enjoy family gaming, binge-watching, or VR experiences.</p><h2>Factors to Consider When Buying a Desktop PC</h2><p>To get the best price-to-performance ratio, it is essential to weigh a few options, as the price is directly related to them. These factors, largely, are the generation of technology, energy efficiency, and computational capacity. Lastly, optional features, PC upgradability, and expansion accessories can slightly alter your initial budget.</p><h3>Performance</h3><p>Desktop PC performance is, by and large, mostly influenced by the processor and generation. The processor (or CPU) is the brain of your computer system. The more powerful processor, the more expensive a desktop PC it gets. The two most popular contenders in this sector are <a href="/component/processor/intel-processor" target="">Intel</a> &amp; <a href="/component/processor/amd-processor" target="">AMD</a>. An <a href="/intel-pc" target="">Intel PC </a>is considered better for higher clock-speed applications. AMD PC is more favorable for multi-core and multi-threaded uses such as video editing, rendering designs, or data analysis.</p><h3>RAM</h3><p>The next most significant desktop PC price &amp; performance factor is the <a href="/component/ram" target="">RAM </a>&amp; storage. A high-performance RAM kit will load programs faster, and a larger capacity on your Desktop RAM will help run multiple apps simultaneously. The latest DDR5 RAM will cost more than DDR4 RAM desktops. DDR5 is very recent, and opting for DDR4 RAM can save a great sum from the projected PC build price.</p><h3>Storage</h3><p>The permanent storage for Desktop PC is provided by either HDD or <a href="/component/SSD-Hard-Disk" target="">SSD</a>. Solid-state State Drives are many times faster than HDD and can also cost a little more. Using an SSD on a Desktop PC for the boot partition is recommended to load any program quickly. M.2 SSD is the latest SSD technology with the highest read/write speeds.</p><h3>Graphics Card</h3><p>For generating the visual outputs, a Desktop PC may or may not come with an integrated GPU, in which case a dedicated <a href="/component/graphics-card" target="">GPU </a>steps into the picture. A dedicated GPU is also called a graphics card. Graphically demanding workloads, like a Gaming desktop PC, will also need a dedicated GPU. </p><h3>Power Supply</h3><p>The Power Supply Unit of a desktop computer is one of the crucial components since clean and surge-free electricity is key to PC health. PSU standards are rated with a certification called the <b>80 Plus Certificate,</b> the bare minimum for a quality power supply. While a quality <a href="/component/power-supply" target="">PSU </a>will enhance the longevity of the system with optimum power delivery, a non-certified PSU can pose a potential hazard to the computer. Brands like <a href="/component/power-supply/Antec-Power" target="">Antec</a>, <a href="/component/power-supply/corsair-psu" target="">Corsair</a>, and Asus bring some of the best PSUs available in the market.</p><h3>Brand Reputation</h3><p>Brand reputation is one of the crucial factors when it comes to Desktop PC prices. Brand value can alter the price of a Desktop PC component or prebuilt-Brand PC at the same time. Many reputed tech giants manufacture personal computers and PC components, such as <a href="/asrock" target="">ASRock</a>, Gigabyte, Asus, Corsair, Antec, Lenovo, Lian Li, Cooler Master, <a href="/nzxt" target="">NZXT</a>, etc. These are some of the reputed <a href="/component" target="">PC component</a> brands for performance and customized desktops.</p><h3>Display Quality</h3><p>The display quality of a PC plays a significant role in the PC experience. If you are buying a PC <a href="/monitor" target="">monitor </a>along with the new system, try going with LED displays. The most sought feature of a desktop monitor is the resolution refresh rate. You will find impressive <a href="/gaming-monitor" target="">Gaming monitors </a>with up to 244Hz refresh rates for premium prices, while 60-100 Hz desktop monitor prices are fairly affordable. On the display resolution, Full HD (1920x1080; FHD) resolution is the bottom line. Going higher than that, such as 2.5K or 4K UHD, will significantly increase the desktop computing experience.</p><h3>Personal Preferences</h3><p>Additional features like setting WiFi on a Desktop or <a href="/accessories" target="">accessories </a>like a keyboard, headphones, mouse, etc. barely alter the standard price, but they are negligible considering the necessity. Premium features, such as gaming features, will add extra costs. You can avoid gaming features such as addressable RGB on components to save money. However, gamers adore them, and feature-rich custom desktop Gaming PCs deliver a better experience with comfort and looks. </p><p><strong>Use Purpose:</strong> By defining the purpose of buying a PC, you can get more insight into the pricing factor for your build. It will help you understand what price range to go for with your system. Set your purpose and then set a budget for your Desktop Computer.</p><p><strong>Upgradeability:</strong> Everybody eventually wants to upgrade their PC with time. So, it is wise to consider enough PCIe lanes and M.2 ports to add new modules later over the years, like a graphics card or an SSD.</p><p><strong>Form Factor:</strong> There are different form factors of desktop PC based on specific demands. All-in-One and Mini PC are excellent choices as office or business PC. For personal computers, there are Full Tower and  Mid Tower cases. One might suit better than the other depending on parameters like cooling function, setup environment, and others.</p><p><strong>Operating System:</strong> Finally, a PC buyer should choose between operating systems for the best use case. The Windows operating system from Microsoft is the most popular one. Apple develops its OS for all Apple devices, and an <a href="/desktops/apple-mini-pc" target="">Apple Mac</a> PC will come with MacOS.</p><h2>Price of Desktop PC in Bangladesh</h2><p>Learning the latest price of <a href="/desktops/" target="">desktop PC</a> helps in budgeting for a Desktop PC. At Star Tech, customers can get the Best Desktop PC in BD to their specified price range. Let’s take a look at what’s on the table from each price segment.</p><p></p><h3>Budget Desktop PC</h3><p>The budget-friendly desktop tier suits users on a limited budget. The lowest price for a budget desktop in Bangladesh starts at as low as 20,000 Taka. Any budget PC option in Bangladesh will have the bare minimum PC configuration for everyday tasks. Browsing, composing an email, or content consumption are best-suited jobs for the budget-friendly Desktop PC.</p><h3>Mid-range Desktop PC</h3><p>For tasks demanding more than multimedia playback or internet surfing, consider the mid-range desktop PC. The Midrange desktop PC price in Bangladesh starts at around 40,000 BDT and reaches up to 100,000 taka. The midrange is a sweet spot for PC buyers who want all the latest features, upscaled performance in gaming, or creative computational works like graphics designing. A Midrange PC will also allow tweaking with your desktop computer for boosted performance, such as overclocking the CPU and RAM.</p><p></p><h3>High-End &amp; Gaming PC</h3><p>A high-performance Gaming PC, or high-end desktops setup (HEDT), is the highest tier of personal computers. These desktop PC are made with state of the art pc components, packed with all the latest and advanced features. A high-performance Gaming PC lets users play the most recent games with high-graphics settings. Besides gaming, this type of Desktop PC is most used in computer labs, large-scale database management, programming, animation, and motion graphics.</p><p>Comprising the most premium parts inside, a high-performance gaming PC price in Bangladesh can go anywhere from 100,000 BDT to more than 750,000 BDT. Purchasing a desktop PC is an investment that requires careful consideration. By understanding your requirements, assessing the latest trends, and exploring the extensive range of desktop PCs available at Star Tech, you can find the perfect match for your computing needs. To get the most advanced Gaming PC, you can visit Star Tech Rig House. Rig House is a PC shop dedicated to developing the highest configuration PC in Bangladesh.</p><h2>Buying From The Best Desktop PC Shop in Bangladesh: Star Tech</h2><p>Star Tech is the best desktop PC shop in Bangladesh, offering the most competitive price on desktop computers. The online shop also has a virtual <a href="/tool/pc_builder" target="">PC builder</a>, which comprises information on the latest price of PC components, compatibility, and many more. Star Tech is also the best place to buy other computing and smart devices, including <a href="/laptop-notebook/laptop" target="">laptops</a>, <a href="/mobile-phone" target="">mobile phones</a>, gadgets, gaming apparatus, and many more. You can order online to get home delivery or visit any of our branches in Dhaka, Chattogram, Rajshahi, Khulna, Rangpur, and Gazipur.</p><h2>Desktop Price in BD: Related FAQ</h2><h3>How Do Gaming Desktop PC Differ From Regular Desktops?</h3><p>Gaming desktop PCs are specially built with PC gaming at the core of use. To deliver the utmost gaming vibes, a Gaming Desktop typically comes with RGB lighting and top-of-the-shelve equipment. They can even have ergonomic features and better build materials to provide a comfortable gaming experience.</p><p></p><h3>Which Processor Is Best For A Desktop PC?: Intel Vs AMD</h3><p>Both AMD and Intel processors are great for desktop PC, but one might bring a better choice over the other based on performance. Intel’s core boost technology is highly considered a favor for gaming since most modern games draw the best performance from boosted clock speeds. On the AMD side, users get an edge in processing latency since they offer more processing cores for less money. Multi-threaded applications such as graphics apps benefit most from higher core counts.</p><p></p><h3>Can I Upgrade My Desktop CPU?</h3><p>Upgrading a Desktop CPU is possible, and it is one of the best PC upgrades for leaping performance gains. You can upgrade your PC CPU to the latest generation, for which the motherboard socket must be compatible. <br></p><h3>What Is The Best PC Configuration For Outsourcing?</h3><p>The best PC for freelance or remote tasks will eventually be the one you can afford without breaking the bank. However, it is also important to consider your use case. In Bangladesh, a desktop PC built with the latest CPU, at least one dedicated GPU, 8 GB RAM, and SSD for storage should cover any outsourcing needs. Plus, you can always have add-ons later as you feel the necessity.</p><h3>How Much Should A Desktop PC Cost In Bangladesh?</h3><p>The budget for buying a desktop PC will vary based on buying factors. However, expect at least 20,000 BDT for standard home PC, 50 to 80,000 BDT for midrange or gaming PC, and 100,000 BDT and beyond for high-end desktops.</p><h3>Where Can I Buy The Best Desktop PC In Bangladesh?</h3><p>In Bangladesh, Star Tech is your one-stop PC shop to get the best desktop on a budget. Offering the most flexible payment methods, EMI, convenient shopping, frequent hot deals, and extended after-sales service, Star Tech Ltd is the leading name when it comes to&nbsp; PC, laptop, gaming, or any tech shopping in BD.</p><p></p>      </div>',

                'related_product_title' => 'show more',
            ]);

            if (isset($item['subcategories'])) {
                foreach ($item['subcategories'] as $subcategory) {
                    self::$model::create([
                        'title' => $subcategory,
                        'serial' => 0,
                        'product_category_group_id' => '1',
                        'parent_id' => $category->id,
                        'image' => $item['image'],

                        'meta_title' => $subcategory,
                        'meta_description' => $subcategory,
                        'meta_keywords' => $subcategory,
                        'search_keywords' => $subcategory,

                        'page_header_title' => $subcategory . " Price in Bangladesh (BD)",
                        'page_header_description' => '<p><span style="font-weight: bold;">Desktop PC</span> Price in Bangladesh starts from BDT 25000 and depending on the configuration the price may go up to BDT 600,000 or more, At Star Tech you can get the latest configured custom Desktop PC, Gaming PC, Brand PC, All-in-One PC, Portable Mini PC etc. Browse below and Order yours now!</p>',

                        'page_full_description_title' => $subcategory . " in Bangladesh",
                        'page_full_description' => '<div class="category-description p-15 ws-box">
                            <h2>Desktop PC in Bangladesh</h2>
                            <p>Welcome to Star Techs <span style="font-weight: bold;">Desktop PC</span> collection, where we house the largest collection of Desktop computers in Bangladesh! From high-end workstations to <a href="/desktops/gaming-pc" target="">Gaming PC</a> and beyond - Star Tech PC shop is the place to be. As the leading computer, tech, and networking equipment vendor in the nation, we take pride in providing the best desktop PC price. Choose from the best PC configurations for freelancing, gaming, and editing. Bringing the PC giants around the world like Asus, HP, Lenovo, and many more, buying a PC for the best price is as easy as surfing the web. We provide an extensive collection of the best desktop PC configurations with detailed price and performance insights, enabling our customers to make informed purchases. With our highly user-friendly e-commerce website and information on the most updated desktop PC price list in BD, you get a wide selection to choose from in 2024.</p><h2>Latest Desktop PC Pricelist in BD 2024</h2>
                            <table class="latest-product-list table-bordered">
                            <tbody><tr><th class="txt-left">Desktop PC List</th><th class="text-right">Price in BD</th></tr>
                            <tr class="latest-product"><td class="product-name"><a href="/lenovo-thinkcentre-neo-50t-gen-4-core-i5-13th-gen-brand-pc">Lenovo ThinkCentre Neo 50t Gen 4 Core i5 13th Gen Brand PC</a></td><td class="product-price text-right">62,500৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-thinkcentre-neo-50t-gen-4-core-i5-12th-gen-brand-pc">Lenovo ThinkCentre Neo 50t Gen 4 Core i5 12th Gen Brand PC</a></td><td class="product-price text-right">60,500৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-thinkcentre-neo-50t-gen-4-core-i3-12th-gen-brand-pc">Lenovo ThinkCentre Neo 50t Gen 4 Core i3 12th Gen Brand PC</a></td><td class="product-price text-right">50,500৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/amd-ryzen-7-7700x-gaming-desktop-pc">AMD Ryzen 7 7700X Gaming Desktop PC</a></td><td class="product-price text-right">149,999৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/intel-core-i5-11400-11th-gen-desktop-pc">Intel Core i5 11400 11th Gen Desktop PC</a></td><td class="product-price text-right">30,999৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-ideacentre-aio-3-24iap7-i7-13th-gen-all-in-one-pc">Lenovo IdeaCentre AIO 3 24IAP7 Core i7 13th Gen 16GB RAM 23.8" All-in-One Desktop PC</a></td><td class="product-price text-right">105,000৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-ideacentre-aio-3-24iap7-core-i5-13th-gen-all-in-one-pc">Lenovo IdeaCentre AIO 3 24IAP7 Core i5 13th Gen 23.8" All-in-One Desktop PC</a></td><td class="product-price text-right">95,000৳</td></tr><tr class="latest-product"><td class="product-name"><a href="/lenovo-ideacentre-aio-3-24iap7-core-i3-12th-gen-all-in-one-pc">Lenovo IdeaCentre AIO 3 24IAP7 Core i3 12th Gen 512GB SSD 23.8" All-in-One Desktop PC</a></td><td class="product-price text-right">73,000৳</td></tr>          </tbody></table>
                            <p></p><h2>Why Choose Star Tech for Buying a Desktop PC?</h2><p>Before delving into the details, let\'s explore why<a href="/desktops/gaming-pc" target=""> Star Tech </a>stands out as the preferred choice for buying desktop PCs in Bangladesh. With over a decade of experience in the tech industry, Star Tech Ltd has established itself as a reputable and reliable source for all types of computing needs. Our commitment to providing top-notch customer service, the most exciting deals and offers, along with a vast collection of the latest desktop PCs from renowned brands, has earned us the trust and loyalty of countless customers.</p><h2>Available Types of Desktop PC in BD</h2><p>At Star Tech, we house the broadest range of Desktop PC, with options from highly energy-efficient, small-form-factor PCs to extensive game-centric ones. Within the PC type spectrum, the Mid Tower form factor is the most popular type of <span style="font-weight: bold;">Desktop PC</span> in BD. Other form factors like Tower and Extended Tower PC are also favored by enthusiast users.</p><h3>Brand Desktop PC</h3><p>A <a href="/desktops/brand-pc" target="">Brand PC</a> or pre-built personal computer is a Desktop system, fully built by a manufacturer. Brand PC is highly popular as a time and energy-saving option since users don’t require taking the hassle of building a PC from scratch. Although a Brand PC may cost a little more than a custom PC of the same configuration, Brand desktop computers also come with some perks. The best one is; they have a very extended warranty, and the support service is great. There will be little or no chance to upgrade a Brand PC.</p><h4>Which Brand of PC is Most Popular in Bangladesh?</h4><p>In Bangladesh, Brand PCs became popular with the advent of broadband internet during the early 2000s. Currently, the most popular PC brands in the country are - <a href="/desktops/brand-pc/acer-desktop" target="">Acer</a>, HP, <a href="/desktops/brand-pc/lenovo-desktop" target="">Lenovo</a>, Apple, <a href="/desktops/brand-pc/asus-desktop" target="">Asus</a>, Dell, and MSI. They are widely used in office and corporate environments since they are usually compact, energy-efficient, and clutter-free.</p><h3>All-in-One PC</h3><p><a href="/desktops/all-in-one-pc" target="">All-in-One PC</a> (AIO PC) is an extremely minimalistic PC form factor in which the complete system is integrated behind the display. This way, only the slim and thin <a href="/monitor" target="">monitor</a> is visible. This is widely popular in offices and among users who prioritize a clean Desktop setup. <a href="/desktops/all-in-one-pc" target="">AIO desktop PC</a> price can be slightly higher than a standard PC with the same prowess.</p><h3>Mini PC</h3><p>Mini PC is another small factor requiring very little space. All the components are set up in a tiny chassis to allow easy movement or hide the PC completely. Brands like ZOTAC &amp; Asus are famous for making very powerful Mini PCs.<a href="/desktops/portable-mini-pc" target=""> Mini PC </a>prices are insignificant, and you can get a Mini Desktop PC at Star Tech for just over 18,000 BDT.</p><h3>Customized Desktop PC</h3><p>A ‘Custom PC’ is a type where the user handpicks all the desktop <a href="/component" target="">components </a>and then assembles them into a computer setup. A custom PC is the most popular approach for buying a desktop computer in modern times since this tier can offer budget options to extremely premium ones. At Star Tech, you can build Desktop PC on a tight budget, or you can build a high-performing custom Gaming computer as well.</p><h4>Gaming Desktop PC</h4><p>Immerse yourself in the world of <a href="/gaming" target="">gaming </a>with the highest-performance gaming desktops. Equipped with cutting-edge <a href="/component/graphics-card" target="">graphics cards </a>and powerful processors, the range of <a href="/desktops/gaming-pc" target="">Gaming Desktop PC </a>at Star Tech accumulates all the winning factors for competitive eSports sessions. Plus, the Gaming PC collection at Star Tech typically comes with ample network and peripheral connectivity options, making any heavy computing loads like gaming or graphics designing a breeze.</p><h4>Business Desktop PC</h4><p>In search of the most cost-efficient PC for your business or office? The Business Desktop PC range at Star Tech is here to lower your burdens, offering durable, stylish, and energy-efficient desktop computers. Enjoy the highest productive hours with the reliable business desktop PCs from Star Tech, designed to handle demanding office tasks for years to come.</p><h4>Home Entertainment PC</h4><p>Revamped home entertainment is the sole purpose of Home PCs. Every home PC built at Star Tech is optimized for the richest multimedia experience with immersive sound and visuals. A Home Entertainment PC is your way to go if you enjoy family gaming, binge-watching, or VR experiences.</p><h2>Factors to Consider When Buying a Desktop PC</h2><p>To get the best price-to-performance ratio, it is essential to weigh a few options, as the price is directly related to them. These factors, largely, are the generation of technology, energy efficiency, and computational capacity. Lastly, optional features, PC upgradability, and expansion accessories can slightly alter your initial budget.</p><h3>Performance</h3><p>Desktop PC performance is, by and large, mostly influenced by the processor and generation. The processor (or CPU) is the brain of your computer system. The more powerful processor, the more expensive a desktop PC it gets. The two most popular contenders in this sector are <a href="/component/processor/intel-processor" target="">Intel</a> &amp; <a href="/component/processor/amd-processor" target="">AMD</a>. An <a href="/intel-pc" target="">Intel PC </a>is considered better for higher clock-speed applications. AMD PC is more favorable for multi-core and multi-threaded uses such as video editing, rendering designs, or data analysis.</p><h3>RAM</h3><p>The next most significant desktop PC price &amp; performance factor is the <a href="/component/ram" target="">RAM </a>&amp; storage. A high-performance RAM kit will load programs faster, and a larger capacity on your Desktop RAM will help run multiple apps simultaneously. The latest DDR5 RAM will cost more than DDR4 RAM desktops. DDR5 is very recent, and opting for DDR4 RAM can save a great sum from the projected PC build price.</p><h3>Storage</h3><p>The permanent storage for Desktop PC is provided by either HDD or <a href="/component/SSD-Hard-Disk" target="">SSD</a>. Solid-state State Drives are many times faster than HDD and can also cost a little more. Using an SSD on a Desktop PC for the boot partition is recommended to load any program quickly. M.2 SSD is the latest SSD technology with the highest read/write speeds.</p><h3>Graphics Card</h3><p>For generating the visual outputs, a Desktop PC may or may not come with an integrated GPU, in which case a dedicated <a href="/component/graphics-card" target="">GPU </a>steps into the picture. A dedicated GPU is also called a graphics card. Graphically demanding workloads, like a Gaming desktop PC, will also need a dedicated GPU. </p><h3>Power Supply</h3><p>The Power Supply Unit of a desktop computer is one of the crucial components since clean and surge-free electricity is key to PC health. PSU standards are rated with a certification called the <b>80 Plus Certificate,</b> the bare minimum for a quality power supply. While a quality <a href="/component/power-supply" target="">PSU </a>will enhance the longevity of the system with optimum power delivery, a non-certified PSU can pose a potential hazard to the computer. Brands like <a href="/component/power-supply/Antec-Power" target="">Antec</a>, <a href="/component/power-supply/corsair-psu" target="">Corsair</a>, and Asus bring some of the best PSUs available in the market.</p><h3>Brand Reputation</h3><p>Brand reputation is one of the crucial factors when it comes to Desktop PC prices. Brand value can alter the price of a Desktop PC component or prebuilt-Brand PC at the same time. Many reputed tech giants manufacture personal computers and PC components, such as <a href="/asrock" target="">ASRock</a>, Gigabyte, Asus, Corsair, Antec, Lenovo, Lian Li, Cooler Master, <a href="/nzxt" target="">NZXT</a>, etc. These are some of the reputed <a href="/component" target="">PC component</a> brands for performance and customized desktops.</p><h3>Display Quality</h3><p>The display quality of a PC plays a significant role in the PC experience. If you are buying a PC <a href="/monitor" target="">monitor </a>along with the new system, try going with LED displays. The most sought feature of a desktop monitor is the resolution refresh rate. You will find impressive <a href="/gaming-monitor" target="">Gaming monitors </a>with up to 244Hz refresh rates for premium prices, while 60-100 Hz desktop monitor prices are fairly affordable. On the display resolution, Full HD (1920x1080; FHD) resolution is the bottom line. Going higher than that, such as 2.5K or 4K UHD, will significantly increase the desktop computing experience.</p><h3>Personal Preferences</h3><p>Additional features like setting WiFi on a Desktop or <a href="/accessories" target="">accessories </a>like a keyboard, headphones, mouse, etc. barely alter the standard price, but they are negligible considering the necessity. Premium features, such as gaming features, will add extra costs. You can avoid gaming features such as addressable RGB on components to save money. However, gamers adore them, and feature-rich custom desktop Gaming PCs deliver a better experience with comfort and looks. </p><p><strong>Use Purpose:</strong> By defining the purpose of buying a PC, you can get more insight into the pricing factor for your build. It will help you understand what price range to go for with your system. Set your purpose and then set a budget for your Desktop Computer.</p><p><strong>Upgradeability:</strong> Everybody eventually wants to upgrade their PC with time. So, it is wise to consider enough PCIe lanes and M.2 ports to add new modules later over the years, like a graphics card or an SSD.</p><p><strong>Form Factor:</strong> There are different form factors of desktop PC based on specific demands. All-in-One and Mini PC are excellent choices as office or business PC. For personal computers, there are Full Tower and  Mid Tower cases. One might suit better than the other depending on parameters like cooling function, setup environment, and others.</p><p><strong>Operating System:</strong> Finally, a PC buyer should choose between operating systems for the best use case. The Windows operating system from Microsoft is the most popular one. Apple develops its OS for all Apple devices, and an <a href="/desktops/apple-mini-pc" target="">Apple Mac</a> PC will come with MacOS.</p><h2>Price of Desktop PC in Bangladesh</h2><p>Learning the latest price of <a href="/desktops/" target="">desktop PC</a> helps in budgeting for a Desktop PC. At Star Tech, customers can get the Best Desktop PC in BD to their specified price range. Let’s take a look at what’s on the table from each price segment.</p><p></p><h3>Budget Desktop PC</h3><p>The budget-friendly desktop tier suits users on a limited budget. The lowest price for a budget desktop in Bangladesh starts at as low as 20,000 Taka. Any budget PC option in Bangladesh will have the bare minimum PC configuration for everyday tasks. Browsing, composing an email, or content consumption are best-suited jobs for the budget-friendly Desktop PC.</p><h3>Mid-range Desktop PC</h3><p>For tasks demanding more than multimedia playback or internet surfing, consider the mid-range desktop PC. The Midrange desktop PC price in Bangladesh starts at around 40,000 BDT and reaches up to 100,000 taka. The midrange is a sweet spot for PC buyers who want all the latest features, upscaled performance in gaming, or creative computational works like graphics designing. A Midrange PC will also allow tweaking with your desktop computer for boosted performance, such as overclocking the CPU and RAM.</p><p></p><h3>High-End &amp; Gaming PC</h3><p>A high-performance Gaming PC, or high-end desktops setup (HEDT), is the highest tier of personal computers. These desktop PC are made with state of the art pc components, packed with all the latest and advanced features. A high-performance Gaming PC lets users play the most recent games with high-graphics settings. Besides gaming, this type of Desktop PC is most used in computer labs, large-scale database management, programming, animation, and motion graphics.</p><p>Comprising the most premium parts inside, a high-performance gaming PC price in Bangladesh can go anywhere from 100,000 BDT to more than 750,000 BDT. Purchasing a desktop PC is an investment that requires careful consideration. By understanding your requirements, assessing the latest trends, and exploring the extensive range of desktop PCs available at Star Tech, you can find the perfect match for your computing needs. To get the most advanced Gaming PC, you can visit Star Tech Rig House. Rig House is a PC shop dedicated to developing the highest configuration PC in Bangladesh.</p><h2>Buying From The Best Desktop PC Shop in Bangladesh: Star Tech</h2><p>Star Tech is the best desktop PC shop in Bangladesh, offering the most competitive price on desktop computers. The online shop also has a virtual <a href="/tool/pc_builder" target="">PC builder</a>, which comprises information on the latest price of PC components, compatibility, and many more. Star Tech is also the best place to buy other computing and smart devices, including <a href="/laptop-notebook/laptop" target="">laptops</a>, <a href="/mobile-phone" target="">mobile phones</a>, gadgets, gaming apparatus, and many more. You can order online to get home delivery or visit any of our branches in Dhaka, Chattogram, Rajshahi, Khulna, Rangpur, and Gazipur.</p><h2>Desktop Price in BD: Related FAQ</h2><h3>How Do Gaming Desktop PC Differ From Regular Desktops?</h3><p>Gaming desktop PCs are specially built with PC gaming at the core of use. To deliver the utmost gaming vibes, a Gaming Desktop typically comes with RGB lighting and top-of-the-shelve equipment. They can even have ergonomic features and better build materials to provide a comfortable gaming experience.</p><p></p><h3>Which Processor Is Best For A Desktop PC?: Intel Vs AMD</h3><p>Both AMD and Intel processors are great for desktop PC, but one might bring a better choice over the other based on performance. Intel’s core boost technology is highly considered a favor for gaming since most modern games draw the best performance from boosted clock speeds. On the AMD side, users get an edge in processing latency since they offer more processing cores for less money. Multi-threaded applications such as graphics apps benefit most from higher core counts.</p><p></p><h3>Can I Upgrade My Desktop CPU?</h3><p>Upgrading a Desktop CPU is possible, and it is one of the best PC upgrades for leaping performance gains. You can upgrade your PC CPU to the latest generation, for which the motherboard socket must be compatible. <br></p><h3>What Is The Best PC Configuration For Outsourcing?</h3><p>The best PC for freelance or remote tasks will eventually be the one you can afford without breaking the bank. However, it is also important to consider your use case. In Bangladesh, a desktop PC built with the latest CPU, at least one dedicated GPU, 8 GB RAM, and SSD for storage should cover any outsourcing needs. Plus, you can always have add-ons later as you feel the necessity.</p><h3>How Much Should A Desktop PC Cost In Bangladesh?</h3><p>The budget for buying a desktop PC will vary based on buying factors. However, expect at least 20,000 BDT for standard home PC, 50 to 80,000 BDT for midrange or gaming PC, and 100,000 BDT and beyond for high-end desktops.</p><h3>Where Can I Buy The Best Desktop PC In Bangladesh?</h3><p>In Bangladesh, Star Tech is your one-stop PC shop to get the best desktop on a budget. Offering the most flexible payment methods, EMI, convenient shopping, frequent hot deals, and extended after-sales service, Star Tech Ltd is the leading name when it comes to&nbsp; PC, laptop, gaming, or any tech shopping in BD.</p><p></p>      </div>',

                        'related_product_title' => 'show more',
                    ]);
                }
            }
        }

        $data =
            [
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1629.jpg",
                    "title" => "চাল ও খাদ্যশস্য"
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2677.jpg",
                    "title" => "যাবতীয় মসলা"
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2696.jpg",
                    "title" => "ডিম ও দুগ্ধপণ্য"
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2674.jpg",
                    "title" => "পানীয়"
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2351.jpg",
                    "title" => "স্ন্যাকস ও বেকারি"
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2720.jpg",
                    "title" => "সবজি ও ফলমূল"
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2872.jpg",
                    "title" => "মাংস ও মাছ"
                ],
                [
                    "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2876.jpg",
                    "title" => "হিমায়িত ও টিনজাত খাদ্য"
                ]
            ];


        foreach ($data as $item) {

            self::$model::create([
                'title' => $item['title'],
                'serial' => 0,
                'product_category_group_id' => '1',
                'parent_id' => 0,
                'is_nav' => 1,
                'image' => $item['image'],
            ]);
        }

        $data = [
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2680.jpg",
                "title" => "চুলের যত্ন"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2678.jpg",
                "title" => "বডি ও বাথ"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2681.jpg",
                "title" => "ত্বক ও মুখমন্ডলের যত্ন"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2679.jpg",
                "title" => "দাঁতের যত্ন"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2685.jpg",
                "title" => "শেভিং ও গ্রুমিং"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2682.jpg",
                "title" => "মহিলাদের স্বাস্থ্যবিধি"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2940.jpg",
                "title" => "মেকআপ"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2186.jpg",
                "title" => "চিকিৎসা ও স্বাস্থ্য"
            ]
        ];
        foreach ($data as $item) {

            self::$model::create([
                'title' => $item['title'],
                'serial' => 0,
                'product_category_group_id' => '2',
                'parent_id' => 0,
                'is_featured' => 0,
                'image' => $item['image'],
            ]);
        }


        $data = [
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2179.jpg",
                "title" => "বড় যন্ত্রপাতি"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2180.jpg",
                "title" => "ছোট যন্ত্রপাতি"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2966.jpg",
                "title" => "ওয়াশার ও ড্রায়ার"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2968.jpg",
                "title" => "অডিও ভিডিও যন্ত্রপাতি"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2971.jpg",
                "title" => "হিটিং, কুলিং ও এয়ার কোয়ালিটি"
            ]
        ];
        foreach ($data as $item) {

            self::$model::create([
                'title' => $item['title'],
                'serial' => 0,
                'product_category_group_id' => '3',
                'parent_id' => 0,
                'is_featured' => 1,
                'image' => $item['image'],
            ]);
        }


        $data = [
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat2129.jpg",
                "title" => "ডেস্কটপ ও ল্যাপটপ"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1240.jpg",
                "title" => "মনিটর"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1925.jpg",
                "title" => "প্রিন্টার ও কপিয়ার"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1520.jpg",
                "title" => "কম্পোনেন্ট"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1521.jpg",
                "title" => "এক্সেসরিজ ও পেরিফেরাল"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1087.jpg",
                "title" => "নেটওয়ার্কিং সরঞ্জামাদি"
            ],
            [
                "image" => "https://m2ce.sindabad.com/media/catalog/category/subcategory/cat1194.jpg",
                "title" => "নজরদারি ও নিরাপত্তা ব্যবস্থা"
            ]
        ];
        foreach ($data as $item) {

            self::$model::create([
                'title' => $item['title'],
                'serial' => 0,
                'product_category_group_id' => '4',
                'parent_id' => 0,
                'image' => $item['image'],
            ]);
        }
    }
}
