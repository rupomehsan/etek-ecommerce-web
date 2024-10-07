<?php

namespace App\Modules\StockManagement\ProductWearHouse;

use App\Modules\StockManagement\ProductWearHouse\Actions\All;
use App\Modules\StockManagement\ProductWearHouse\Actions\Destroy;
use App\Modules\StockManagement\ProductWearHouse\Actions\Show;
use App\Modules\StockManagement\ProductWearHouse\Actions\Store;
use App\Modules\StockManagement\ProductWearHouse\Actions\Update;
use App\Modules\StockManagement\ProductWearHouse\Actions\SoftDelete;
use App\Modules\StockManagement\ProductWearHouse\Actions\Restore;
use App\Modules\StockManagement\ProductWearHouse\Actions\Import;
use App\Modules\StockManagement\ProductWearHouse\Validations\BulkActionsValidation;
use App\Modules\StockManagement\ProductWearHouse\Validations\GetAllValidation;
use App\Modules\StockManagement\ProductWearHouse\Validations\Validation;
use App\Modules\StockManagement\ProductWearHouse\Actions\BulkActions;
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
