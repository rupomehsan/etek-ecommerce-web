<?php

namespace App\Modules\ProductManagement\ProductUnit;

use App\Modules\ProductManagement\ProductUnit\Actions\All;
use App\Modules\ProductManagement\ProductUnit\Actions\Destroy;
use App\Modules\ProductManagement\ProductUnit\Actions\Show;
use App\Modules\ProductManagement\ProductUnit\Actions\Store;
use App\Modules\ProductManagement\ProductUnit\Actions\Update;
use App\Modules\ProductManagement\ProductUnit\Actions\SoftDelete;
use App\Modules\ProductManagement\ProductUnit\Actions\Restore;
use App\Modules\ProductManagement\ProductUnit\Actions\Import;
use App\Modules\ProductManagement\ProductUnit\Validations\BulkActionsValidation;
use App\Modules\ProductManagement\ProductUnit\Validations\GetAllValidation;
use App\Modules\ProductManagement\ProductUnit\Validations\Validation;
use App\Modules\ProductManagement\ProductUnit\Actions\BulkActions;
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