<?php

namespace App\Modules\SalesManagement\SalesReturn;

use App\Modules\SalesManagement\SalesReturn\Actions\All;
use App\Modules\SalesManagement\SalesReturn\Actions\Destroy;
use App\Modules\SalesManagement\SalesReturn\Actions\Show;
use App\Modules\SalesManagement\SalesReturn\Actions\Store;
use App\Modules\SalesManagement\SalesReturn\Actions\Update;
use App\Modules\SalesManagement\SalesReturn\Actions\SoftDelete;
use App\Modules\SalesManagement\SalesReturn\Actions\Restore;
use App\Modules\SalesManagement\SalesReturn\Actions\Import;
use App\Modules\SalesManagement\SalesReturn\Validations\BulkActionsValidation;
use App\Modules\SalesManagement\SalesReturn\Validations\GetAllValidation;
use App\Modules\SalesManagement\SalesReturn\Validations\Validation;
use App\Modules\SalesManagement\SalesReturn\Actions\BulkActions;
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