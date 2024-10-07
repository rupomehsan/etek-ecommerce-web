<?php

namespace App\Modules\StockManagement\ProductStock;

use App\Modules\StockManagement\ProductStock\Actions\All;
use App\Modules\StockManagement\ProductStock\Actions\Destroy;
use App\Modules\StockManagement\ProductStock\Actions\Show;
use App\Modules\StockManagement\ProductStock\Actions\Store;
use App\Modules\StockManagement\ProductStock\Actions\Update;
use App\Modules\StockManagement\ProductStock\Actions\SoftDelete;
use App\Modules\StockManagement\ProductStock\Actions\Restore;
use App\Modules\StockManagement\ProductStock\Actions\Import;
use App\Modules\StockManagement\ProductStock\Validations\BulkActionsValidation;
use App\Modules\StockManagement\ProductStock\Validations\GetAllValidation;
use App\Modules\StockManagement\ProductStock\Validations\Validation;
use App\Modules\StockManagement\ProductStock\Actions\BulkActions;
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
