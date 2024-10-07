<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Modules\UserManagement\UserCustomerType\Database\Seeder as UserCustomerTypeSeeder;
use App\Modules\UserManagement\UserSupplierType\Database\Seeder as UserSupplierTypeSeeder;
use App\Modules\UserManagement\UserRole\Database\Seeder as UserRoleSeeder;
use App\Modules\UserManagement\UserPermission\Database\Seeder as UserPermissionSeeder;
use App\Modules\UserManagement\User\Database\Seeder as UserSeeder;
//product seeder
use App\Modules\ProductManagement\ProductCategoryGroup\Database\Seeder as ProductCategoryGroupSeeder;
use App\Modules\ProductManagement\ProductCategory\Database\Seeder as ProductCategorySeeder;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Database\Seeder as ProductCategoryWiseAdvertiseSeeder;

use App\Modules\ProductManagement\ProductBrand\Database\Seeder as ProductBrandSeeder;
use App\Modules\ProductManagement\ProductMenufacturer\Database\Seeder as ProductMenufacturerSeeder;

use App\Modules\ProductManagement\ProductUnitGroup\Database\Seeder as ProductUnitGroupSeeder;
use App\Modules\ProductManagement\ProductUnit\Database\Seeder as ProductUnitSeeder;

use App\Modules\ProductManagement\ProductBarCode\Database\Seeder as ProductBarCodeSeeder;

use App\Modules\ProductManagement\ProductVarientGroup\Database\Seeder as ProducVariantGroupSeeder;
use App\Modules\ProductManagement\ProductVarient\Database\Seeder as ProductVariantSeeder;
use App\Modules\ProductManagement\ProductVarientValue\Database\Seeder as ProductVariantValueSeeder;


use App\Modules\ProductManagement\Product\Database\Seeder as ProductSeeder;
//location seeder
use App\Modules\LocationManagement\Country\Database\Seeder as CountrySeeder;
use App\Modules\LocationManagement\StateDivision\Database\Seeder as StateDivisionSeeder;
use App\Modules\LocationManagement\District\Database\Seeder as DistrictSeeder;
use App\Modules\LocationManagement\Station\Database\Seeder as StationSeeder;
//vat management seeder
use App\Modules\VatManagement\Vat\Database\Seeder as VatSeeder;
use App\Modules\VatManagement\VatGroup\Database\Seeder as VatGroupSeeder;
//Purchase management seeder
use App\Modules\PurchageManagement\PurchaseOrder\Database\Seeder as ProductWareHouseSeeder;
use App\Modules\PurchageManagement\PurchaseOrder\Database\Seeder as PurchaseOrderSeeder;
//Stock management seeder
use App\Modules\StockManagement\ProductWearHouseBranch\Database\Seeder as ProductWearHouseBranchSeeder;
use App\Modules\StockManagement\ProductWearHouse\Database\Seeder as ProductWearHouseSeeder;
//Sales order management seeder
use App\Modules\SalesManagement\SalesEcommerceOrder\Database\Seeder as SalesEcommerceOrderSeeder;

//Website seeder
//Website seeder

//HomeBanner  seeder
use App\Modules\BannerManagement\HomeBanner\Database\Seeder as HomeBannerSeeder;
use App\Modules\BannerManagement\HomeSideBanner\Database\Seeder as HomeSideBannerSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //user management seeder
            UserCustomerTypeSeeder::class,
            UserSupplierTypeSeeder::class,
            UserRoleSeeder::class,
            UserPermissionSeeder::class,
            UserSeeder::class,
            //product management seeder
            // ProductCategoryGroupSeeder::class,
            // ProductCategorySeeder::class,
            // ProductCategoryWiseAdvertiseSeeder::class,

            // ProductBrandSeeder::class,
            // ProductMenufacturerSeeder::class,

            // ProductUnitGroupSeeder::class,
            // ProductUnitSeeder::class,

            // ProductBarCodeSeeder::class,

            // ProducVariantGroupSeeder::class,
            // ProductVariantSeeder::class,
            // ProductVariantValueSeeder::class,


            // ProductSeeder::class,
            
            // location management
            CountrySeeder::class,
            StateDivisionSeeder::class,
            DistrictSeeder::class,
            StationSeeder::class,

            //vat management seeder
            VatSeeder::class,
            VatGroupSeeder::class,
            //Stock  management seeder
            ProductWearHouseBranchSeeder::class,
            ProductWearHouseSeeder::class,
            //Purchase management seeder
            PurchaseOrderSeeder::class,

            //Sales order management seeder
            SalesEcommerceOrderSeeder::class,


            //Website seeder
            //Website seeder
            //Home banner seeder
            HomeBannerSeeder::class,
            HomeSideBannerSeeder::class,
        ]);
    }
}
