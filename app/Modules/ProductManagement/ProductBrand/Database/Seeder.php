<?php

namespace App\Modules\ProductManagement\ProductBrand\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ProductManagement\ProductBrand\Database\Seeder"
     */
    static $model = \App\Modules\ProductManagement\ProductBrand\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $data = [
            [
                "title" => "Asus",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/asus-100x100.jpg"
            ],
            [
                "title" => "Lenovo",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/lenovo-100x100.jpg"
            ],
            [
                "title" => "Brother",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/brother-color-1-100x100.png"
            ],
            [
                "title" => "LG",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/lg-color-1-100x100.png"
            ],
            [
                "title" => "A4Tech",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/a4tech-color-100x100.png"
            ],
            [
                "title" => "Rapoo",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/RAPOo-100x100.jpg"
            ],
            [
                "title" => "Adata",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/adata-logo-100x100.png"
            ],
            [
                "title" => "Dell",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/dell-logo-png-100x100.png"
            ],
            [
                "title" => "Cudy",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/download-100x100.jpg"
            ],
            [
                "title" => "Boya",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/Boya%20Mic/Boya-Black-100x100.jpg"
            ],
            [
                "title" => "Sharp",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/sharp-color-1-100x100.png"
            ],
            [
                "title" => "Microlab",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Microlab-Logo-100x100.jpg"
            ],
            [
                "title" => "Seagate",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/seagate-global-brand-pvt-ltd-100x100.jpg"
            ],
            [
                "title" => "Lexar",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/download%20(1)-100x100.png"
            ],
            [
                "title" => "Dynabook",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/dynabook-new-100x100.jpg"
            ],
            [
                "title" => "Evolis",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/evolis-logo-global-brand-100x100.png"
            ],
            [
                "title" => "Toshiba",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/toshiba-color-100x100.png"
            ],
            [
                "title" => "Hikvision",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/hikvision-color-100x100.png"
            ],
            [
                "title" => "NZXT",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/nzxt-color-100x100.png"
            ],
            [
                "title" => "Philips",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/philips-color-1-100x100.png"
            ],
            [
                "title" => "Cooler Master",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/cooler-master-100x100.jpg"
            ],
            [
                "title" => "Autodesk",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/AUTODESK-COLOR-100x100.png"
            ],
            [
                "title" => "Bitdefender",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/bitdefendat-color-100x100.png"
            ],
            [
                "title" => "Xigmatek",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/xigma-tek-color-100x100.png"
            ],
            [
                "title" => "HP Enterprise ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/hp-e-100x100.jpg"
            ],
            [
                "title" => "Vention",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/vention-logo-global-brand-online-shop%20(1)-100x100.jpg"
            ],
            [
                "title" => "Juniper",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/juniper-gray-100x100.png"
            ],
            [
                "title" => "Acer",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/ACER-COLOR-100x100.png"
            ],
            [
                "title" => "Golden Field",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/golden-field-100x100.png"
            ],
            [
                "title" => "Power Guard ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/power-guard-color-100x100.png"
            ],
            [
                "title" => "Panda",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/panda-color-1-100x100.png"
            ],
            [
                "title" => "WatchGuard",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/WATCHGUARD-NEW-LOGO-100x100.jpg"
            ],
            [
                "title" => "Ugreen",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/UGREEN-LOGO-100x100.jpg"
            ],
            [
                "title" => "Vertiv",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/vertiv-color-100x100.png"
            ],
            [
                "title" => "Totolink",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/totolink-color-1-100x100.png"
            ],
            [
                "title" => "Vivitek",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/vivitek-color-1-100x100.png"
            ],
            [
                "title" => "Cote ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/cote-100x100.jpg"
            ],
            [
                "title" => "Ofitech",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/ofitech-brand-logo-100x100.jpg"
            ],
            [
                "title" => "Cisco",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/cisco-100x100.jpg"
            ],
            [
                "title" => "Apple",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/apple_logo-100x100.jpg"
            ],
            [
                "title" => "Microsoft",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Microsoft-100x100.png"
            ],
            [
                "title" => "Mikrotik",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/MIKROTIK-COLOR-100x100.png"
            ],
            [
                "title" => "Intel ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/intel-100x100.jpg"
            ],
            [
                "title" => "AMD",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/amd-100x100.png"
            ],
            [
                "title" => "Belden",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/Belden/BELDEN-NEW-LOGO-100x100.jpg"
            ],
            [
                "title" => "Planet",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/planet-color-100x100.png"
            ],
            [
                "title" => "Vmware",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/vmware-color-100x100.png"
            ],
            [
                "title" => "Sophos",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/sophos-color-100x100.png"
            ],
            [
                "title" => "Avision",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/avision-100x100.jpg"
            ],
            [
                "title" => "Tysso",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/tysso-100x100.jpg"
            ],
            [
                "title" => "Kington",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/kington-color-100x100.png"
            ],
            [
                "title" => "Realview",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Realview%20Logo%20For%20Website-01-100x100.jpg"
            ],
            [
                "title" => "Tipsoi",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/tip-soi-100x100.jpg"
            ],
            [
                "title" => "Huntkey",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Huntkey-color-100x100.png"
            ],
            [
                "title" => "SPRT",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/sprt-100x100.png"
            ],
            [
                "title" => "Check Point",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/Checkpoint-100x100.jpg"
            ],
            [
                "title" => "Avaya",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/avaya-color-100x100.png"
            ],
            [
                "title" => "Voltan",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/voltan-logo-100x100.jpg"
            ],
            [
                "title" => "ViewSonic ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/06cabf04792763817ce6ad41f5ead93f-100x100.jpeg"
            ],
            [
                "title" => "Canon",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/canon_logo-100x100-100x100.jpg"
            ],
            [
                "title" => "Sony",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/sony_logo-100x100-100x100.jpg"
            ],
            [
                "title" => "Ericsson",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/ericsson-100x100.jpg"
            ],
            [
                "title" => "Barracuda ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Barracuda%20network-100x100h.jpg"
            ],
            [
                "title" => "Casio",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/casio-color-1-100x100.png"
            ],
            [
                "title" => "Czur",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/czur-color-100x100.png"
            ],
            [
                "title" => "Hold-key ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/HOLD-KEY-COLOR-100x100.png"
            ],
            [
                "title" => "Huawei",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/huawei-color-100x100.png"
            ],
            [
                "title" => "Micronet",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/micronet-color-100x100.png"
            ],
            [
                "title" => "Adobe",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/adobe-color-100x100.png"
            ],
            [
                "title" => "Ansys",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/ansys-color-100x100.png"
            ],
            [
                "title" => "Microtek",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/microtek-color-100x100.png"
            ],
            [
                "title" => "Midas",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/midas-color-100x100.png"
            ],
            [
                "title" => "Mustek",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/mustek-color-100x100.png"
            ],
            [
                "title" => "Panasonic",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/panasonic-color-1-100x100.png"
            ],
            [
                "title" => "Phanteks ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/PHANTEKS-COLOR-100x100.png"
            ],
            [
                "title" => "Palo Alto",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/paloaltp-color-100x100.png"
            ],
            [
                "title" => "QNAP",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/qnap-color-100x100.png"
            ],
            [
                "title" => "Redhat",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/redhat-color-100x100.png"
            ],
            [
                "title" => "Seasonic ",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/seasonic-color-100x100.png"
            ],
            [
                "title" => "Sewoo",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/sewoo-color-100x100.png"
            ],
            [
                "title" => "Suprema",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/suprema-color-100x100.png"
            ],
            [
                "title" => "Trimble",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/trimble-color-100x100.png"
            ],
            [
                "title" => "Zebex",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/zebex-color-1-100x100.png"
            ],
            [
                "title" => "ZKTeco",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/zkteco-100x100.jpg"
            ],
            [
                "title" => "NEC",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/NEC-100x100.jpg"
            ],
            [
                "title" => "Nikon",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/nikon-logo-100x100.png"
            ],
            [
                "title" => "Maipu",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/maipu-100x100.jpg"
            ],
            [
                "title" => "Air Pro",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/air%20Pro%20-%20Global%20Brand%20Pvt%20Ltd-100x100.jpeg"
            ],
            [
                "title" => "WI-TEK",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/Banners/wi-tek-100x100.jpg"
            ],
            [
                "title" => "Newline",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Product-size-TEMPLATE-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-Recovered-100x100.jpg"
            ],
            [
                "title" => "HID",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/hid%20logo-100x100.jpg"
            ],
            [
                "title" => "Kodak",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/kodak-100x100.jpg"
            ],
            [
                "title" => "Leoch",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/leoch-battery-global-brand-pvt-ltd-e1609660784383-100x100.jpg"
            ],
            [
                "title" => "HP",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/hp-100x100.jpg"
            ],
            [
                "title" => "Cambium",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Cambium%20Networks%20-%20Global%20Brand%20Pvt%20Ltd-100x100.jpeg"
            ],
            [
                "title" => "Uniview",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/UniView-100x100.png"
            ],
            [
                "title" => "Aresze",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/Aresze/Aresze-100x100.png"
            ],
            [
                "title" => "Arktek",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/ARKTEK-2-100x100.jpg"
            ],
            [
                "title" => "PNY",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/PNY-100x100.png"
            ],
            [
                "title" => "Epson",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/Epson-100x100.png"
            ],
            [
                "title" => "ZTE",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/ZTE-100x100.png"
            ],
            [
                "title" => "BDCOM",
                "image" => "https://www.globalbrand.com.bd/image/cache/catalog/GBPL%20Brands/BDCOM-2-100x100.png"
            ]
        ];

        foreach ($data as $key => $item) {
            self::$model::create([
                'title' => $item['title'],
                'serial' => 0,
                'is_featured' => rand(0, 1),
                'image' => $item['image'],
            ]);
        }
    }
}
