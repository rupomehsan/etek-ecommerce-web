<?php

namespace App\Modules\UserManagement\User\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class UserEmployeeInformationModel extends EloquentModel
{
    protected $table = "user_employee_informations";
    protected $guarded = [];
}
