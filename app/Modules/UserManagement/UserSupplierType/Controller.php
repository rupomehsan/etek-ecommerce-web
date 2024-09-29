<?php

namespace App\Modules\UserManagement\UserSupplierType;

use App\Modules\UserManagement\UserSupplierType\Actions\All;
use App\Modules\UserManagement\UserSupplierType\Actions\Delete;
use App\Modules\UserManagement\UserSupplierType\Actions\Show;
use App\Modules\UserManagement\UserSupplierType\Actions\Store;
use App\Modules\UserManagement\UserSupplierType\Actions\Update;
use App\Modules\UserManagement\UserSupplierType\Validations\Validation;
use App\Modules\UserManagement\UserSupplierType\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index()
    {
        $data = All::execute();
        return $data;
    }

    public function store(Validation $request)
    {
        $data = Store::execute($request);
        return $data;
    }

    public function show($id)
    {
        $data = Show::execute($id);
        return $data;
    }

    public function update(Validation $request, $id)
    {
        $data = Update::execute($request, $id);
        return $data;
    }

    public function destroy($id)
    {
        $data = Delete::execute($id);
        return $data;
    }
    public function bulkAction()
    {
        $data = BulkActions::execute();
        return $data;
    }

}