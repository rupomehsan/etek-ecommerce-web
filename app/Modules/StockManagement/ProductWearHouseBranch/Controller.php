<?php

namespace App\Modules\StockManagement\ProductWearHouseBranch;

use App\Modules\StockManagement\ProductWearHouseBranch\Actions\All;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\Destroy;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\Show;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\Store;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\Update;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\SoftDelete;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\Restore;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\Import;
use App\Modules\StockManagement\ProductWearHouseBranch\Validations\BulkActionsValidation;
use App\Modules\StockManagement\ProductWearHouseBranch\Validations\GetAllValidation;
use App\Modules\StockManagement\ProductWearHouseBranch\Validations\Validation;
use App\Modules\StockManagement\ProductWearHouseBranch\Actions\BulkActions;
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