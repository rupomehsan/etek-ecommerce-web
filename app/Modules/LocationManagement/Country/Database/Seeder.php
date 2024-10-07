<?php
namespace App\Modules\LocationManagement\Country\Database;


use Illuminate\Database\Seeder as SeederClass;
use Illuminate\Support\Facades\File;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\LocationManagement\Country\Database\Seeder"
     */
    static $model = \App\Modules\LocationManagement\Country\Models\Model::class;
    public function run(): void
    {

        self::$model::truncate();
        $path = public_path('vendor/json/all-countries-filter.json');

        if (!File::exists($path)) {
            abort(404, 'File not found');
        }

        $file = File::get($path);
        $data = json_decode($file, true);
        foreach ($data as $country) {
            self::$model::create([
                'name' => $country['name'],
                'country_short_code' => $country['country_short_code'],
                'flag_url' => $country['flag_url'],
                'country_code' => $country['country_code'],
                'country_symbol' => $country['country_symbol'],
                'serial' => $country['name'] == "Bangladesh" ? 1 : null,
            ]);
        }
    }


}

