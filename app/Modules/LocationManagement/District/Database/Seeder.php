<?php
namespace App\Modules\LocationManagement\District\Database;

use Illuminate\Database\Seeder as SeederClass;
use Illuminate\Support\Facades\File;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\LocationManagement\District\Database\Seeder"
     */
    static $model = \App\Modules\LocationManagement\District\Models\Model::class;
    static $countryModel = \App\Modules\LocationManagement\Country\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();

        $country = self::$countryModel::where('serial',1)->first();
        $country_id = null;
        if ($country) {
            $country_id = $country->id;
        }

        $path = public_path('vendor/json/bd-districts.json');
        if (!File::exists($path)) {
            abort(404, 'File not found');
        }

        $file = File::get($path);
        $data = json_decode($file, true);
        foreach ($data as $district) {
            self::$model::create([
                'country_id' => $country_id,
                'state_division_id' => $district['division_id'],
                'name' => $district['name'],
            ]);
        }
    }
}
