<?php
namespace App\Modules\LocationManagement\StateDivision\Database;

use Illuminate\Database\Seeder as SeederClass;
use Illuminate\Support\Facades\File;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\LocationManagement\StateDivision\Database\Seeder"
     */
    static $model = \App\Modules\LocationManagement\StateDivision\Models\Model::class;
    static $country_model = \App\Modules\LocationManagement\Country\Models\Model::class;
    public function run(): void
    {
        $country_id = self::$country_model::where('serial', 1)->first()->id;

        self::$model::truncate();
        $path = public_path('vendor/json/all-division.json');

        if (!File::exists($path)) {
            abort(404, 'File not found');
        }

        $file = File::get($path);
        $data = json_decode($file, true);
        foreach ($data as $division) {
            self::$model::create([
                'country_id' => $country_id,
                'name' => $division["name"],
            ]);
        }
    }
}
