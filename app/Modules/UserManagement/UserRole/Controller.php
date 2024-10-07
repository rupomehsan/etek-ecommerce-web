<?php

namespace App\Modules\UserManagement\UserRole;

use App\Modules\UserManagement\UserRole\Actions\All;
use App\Modules\UserManagement\UserRole\Actions\Delete;
use App\Modules\UserManagement\UserRole\Actions\Show;
use App\Modules\UserManagement\UserRole\Actions\Store;
use App\Modules\UserManagement\UserRole\Actions\Update;
use App\Modules\UserManagement\UserRole\Validations\Validation;
use App\Modules\UserManagement\UserRole\Actions\BulkActions;
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