<?php

namespace App\Modules\ProductManagement\ProductCategory;

use App\Modules\ProductManagement\ProductCategory\Actions\All;
use App\Modules\ProductManagement\ProductCategory\Actions\Destroy;
use App\Modules\ProductManagement\ProductCategory\Actions\Show;
use App\Modules\ProductManagement\ProductCategory\Actions\Store;
use App\Modules\ProductManagement\ProductCategory\Actions\Update;
use App\Modules\ProductManagement\ProductCategory\Actions\SoftDelete;
use App\Modules\ProductManagement\ProductCategory\Actions\Restore;
use App\Modules\ProductManagement\ProductCategory\Actions\Import;
use App\Modules\ProductManagement\ProductCategory\Validations\BulkActionsValidation;
use App\Modules\ProductManagement\ProductCategory\Validations\GetAllValidation;
use App\Modules\ProductManagement\ProductCategory\Validations\Validation;
use App\Modules\ProductManagement\ProductCategory\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index(GetAllValidation $request)
    {
        $data = All::execute($request);
        return $data;
    }

    public function get_all()
    {
        $data = \App\Modules\ProductManagement\ProductCategory\Models\Model::query()
            ->where([
                "parent_id" => 0,
            ])
            ->with('all_childrens')
            ->get();
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
