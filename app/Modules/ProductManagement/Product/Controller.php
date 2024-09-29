<?php

namespace App\Modules\ProductManagement\Product;

use App\Modules\ProductManagement\Product\Actions\All;
use App\Modules\ProductManagement\Product\Actions\Destroy;
use App\Modules\ProductManagement\Product\Actions\Show;
use App\Modules\ProductManagement\Product\Actions\Store;
use App\Modules\ProductManagement\Product\Actions\Update;
use App\Modules\ProductManagement\Product\Actions\SoftDelete;
use App\Modules\ProductManagement\Product\Actions\Restore;
use App\Modules\ProductManagement\Product\Actions\Import;
use App\Modules\ProductManagement\Product\Validations\BulkActionsValidation;
use App\Modules\ProductManagement\Product\Validations\GetAllValidation;
use App\Modules\ProductManagement\Product\Validations\Validation;
use App\Modules\ProductManagement\Product\Actions\BulkActions;
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
    public function ProductMaxMinPrice()
    {
        $data = BulkActions::execute($request);
        return $data;
    }

}
