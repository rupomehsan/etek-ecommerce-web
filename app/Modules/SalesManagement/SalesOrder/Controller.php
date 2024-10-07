<?php

namespace App\Modules\SalesManagement\SalesOrder;

use App\Modules\SalesManagement\SalesOrder\Actions\All;
use App\Modules\SalesManagement\SalesOrder\Actions\Destroy;
use App\Modules\SalesManagement\SalesOrder\Actions\Show;
use App\Modules\SalesManagement\SalesOrder\Actions\Store;
use App\Modules\SalesManagement\SalesOrder\Actions\Update;
use App\Modules\SalesManagement\SalesOrder\Actions\SoftDelete;
use App\Modules\SalesManagement\SalesOrder\Actions\Restore;
use App\Modules\SalesManagement\SalesOrder\Actions\Import;
use App\Modules\SalesManagement\SalesOrder\Validations\BulkActionsValidation;
use App\Modules\SalesManagement\SalesOrder\Validations\GetAllValidation;
use App\Modules\SalesManagement\SalesOrder\Validations\Validation;
use App\Modules\SalesManagement\SalesOrder\Actions\BulkActions;
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