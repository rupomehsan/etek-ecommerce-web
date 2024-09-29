<?php

namespace App\Modules\ProductManagement\ProductOffer;

use App\Modules\ProductManagement\ProductOffer\Actions\All;
use App\Modules\ProductManagement\ProductOffer\Actions\Destroy;
use App\Modules\ProductManagement\ProductOffer\Actions\Show;
use App\Modules\ProductManagement\ProductOffer\Actions\Store;
use App\Modules\ProductManagement\ProductOffer\Actions\Update;
use App\Modules\ProductManagement\ProductOffer\Actions\SoftDelete;
use App\Modules\ProductManagement\ProductOffer\Actions\Restore;
use App\Modules\ProductManagement\ProductOffer\Actions\Import;
use App\Modules\ProductManagement\ProductOffer\Validations\BulkActionsValidation;
use App\Modules\ProductManagement\ProductOffer\Validations\GetAllValidation;
use App\Modules\ProductManagement\ProductOffer\Validations\Validation;
use App\Modules\ProductManagement\ProductOffer\Actions\BulkActions;
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