<?php
namespace App\Modules\LocationManagement\Station\Database;

use Illuminate\Database\Seeder as SeederClass;
use Illuminate\Support\Facades\File;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\LocationManagement\Station\Database\Seeder"
     */
    static $model = \App\Modules\LocationManagement\Station\Models\Model::class;
    static $districtModel = \App\Modules\LocationManagement\District\Models\Model::class;
    static $stateDivisionModel = \App\Modules\LocationManagement\StateDivision\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        $path = public_path('vendor/json/bd-thana.json');
        if (!File::exists($path)) {
            abort(404, 'File not found');
        }

        $file = File::get($path);
        $data = json_decode($file, true);
        foreach ($data as $thana) {
            $is_exist_thana = self::$model::where('name',$thana['thana'])->exists();
            if(!$is_exist_thana){
                $district = self::$districtModel::where('name',$thana['district'])->first();
                $country_id = $district->country_id ?? 216 ;
                $district_id = $district->id ?? 64;
                $state_division_id = $district->state_division_id ?? 8;

                self::$model::create([
                    'country_id' => $country_id,
                    'state_division_id' =>  $state_division_id,
                    'district_id' => $district_id,
                    'name' => $thana['thana'],
                    'post_office' => $thana['post_office'],
                    'post_code' => $thana['post_code'],
                ]);
            }
        }
        // for ($i = 1; $i < 100; $i++) {
        // self::$model::create([
        //     'country_id' => facker()->name,
        //     'state_division_id' => facker()->name,
        //     'district_id' => facker()->name,
        //     'name' => facker()->name,
        //     'post_office' => facker()->name,
        //     'post_code' => facker()->name,
        //     ]);
        // }
    }
}