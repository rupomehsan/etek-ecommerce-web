<?php

namespace App\Modules\UserManagement\User\Controllers;

use App\Modules\UserManagement\User\Actions\Employee\All;
use App\Modules\UserManagement\User\Actions\Employee\Destroy;
use App\Modules\UserManagement\User\Actions\Employee\Show;
use App\Modules\UserManagement\User\Actions\Employee\Store;
use App\Modules\UserManagement\User\Actions\Employee\Update;
use App\Modules\UserManagement\User\Validations\Validation;
use App\Modules\UserManagement\User\Actions\Employee\BulkActions;
use App\Modules\UserManagement\User\Actions\Employee\SoftDelete;
use App\Modules\UserManagement\User\Actions\Employee\Restore;
use App\Http\Controllers\Controller as ControllersController;
use App\Modules\UserManagement\User\Actions\Employee\Import;
use App\Modules\UserManagement\User\Validations\BulkActionsValidation;
use App\Modules\UserManagement\User\Validations\GetAllValidation;

class EmployeeController extends ControllersController
{

    public function index(GetAllValidation $request)
    {

        $data = All::execute($request);
        return $data;
    }

    public function store(Validation $request)
    {
        $data = Store::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = Show::execute($slug);
        return $data;
    }

    public function update(Validation $request, $id)
    {

        $data = Update::execute($request, $id);
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy()
    {
        $data = Destroy::execute();
        return $data;
    }
    public function restore()
    {
        $data = Restore::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }
    public function import()
    {
        $data = Import::execute();
        return $data;
    }
}
