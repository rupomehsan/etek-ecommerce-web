<?php

namespace App\Modules\UserManagement\UserRetailerType;

use App\Modules\UserManagement\UserRetailerType\Actions\All;
use App\Modules\UserManagement\UserRetailerType\Actions\Destroy;
use App\Modules\UserManagement\UserRetailerType\Actions\Show;
use App\Modules\UserManagement\UserRetailerType\Actions\Store;
use App\Modules\UserManagement\UserRetailerType\Actions\Update;
use App\Modules\UserManagement\UserRetailerType\Actions\SoftDelete;
use App\Modules\UserManagement\UserRetailerType\Actions\Restore;
use App\Modules\UserManagement\UserRetailerType\Actions\Import;
use App\Modules\UserManagement\UserRetailerType\Validations\BulkActionsValidation;
use App\Modules\UserManagement\UserRetailerType\Validations\GetAllValidation;
use App\Modules\UserManagement\UserRetailerType\Validations\Validation;
use App\Modules\UserManagement\UserRetailerType\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
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

    public function update(Validation $request, $slug)
    {
        $data = Update::execute($request, $slug);
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = Destroy::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = Restore::execute();
        return $data;
    }
    public function import()
    {
        $data = Import::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }

}