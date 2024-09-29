<?php

namespace App\Modules\ProductManagement\ProductCategoryWiseAdvertise;

use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\All;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\Destroy;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\Show;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\Store;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\Update;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\SoftDelete;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\Restore;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\Import;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Validations\BulkActionsValidation;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Validations\GetAllValidation;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Validations\Validation;
use App\Modules\ProductManagement\ProductCategoryWiseAdvertise\Actions\BulkActions;
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