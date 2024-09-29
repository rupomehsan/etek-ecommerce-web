<?php

namespace App\Modules\UserManagement\User\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;


class UserAddressModel extends EloquentModel
{
    static $userAddressContactPersonModel = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    static $userModel = \App\Modules\UserManagement\User\Models\Model::class;
    protected $table = "user_addresses";
    protected $guarded = [];

    static $divisionModel = \App\Modules\LocationManagement\StateDivision\Models\Model::class;
    static $disctrictModel = \App\Modules\LocationManagement\District\Models\Model::class;
    static $stationModel = \App\Modules\LocationManagement\Station\Models\Model::class;

    public function user_address_contact_person()
    {
        return $this->hasMany(self::$userAddressContactPersonModel, 'user_address_id', 'id');
    }

    public function contact_persons()
    {
        return $this->hasMany(self::$userAddressContactPersonModel, 'user_address_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(self::$userModel, 'id', 'user_id');
    }

    public function division()
    {
        return $this->belongsTo(self::$divisionModel, 'division_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(self::$disctrictModel, 'district_id', 'id');
    }
    public function station()
    {
        return $this->belongsTo(self::$stationModel, 'station_id', 'id');
    }
}
