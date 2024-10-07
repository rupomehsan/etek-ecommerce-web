<?php

namespace App\Modules\PurchageManagement\PurchaseReturnOrder;

use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\All;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\Destroy;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\Show;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\Store;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\Update;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\SoftDelete;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\Restore;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\Import;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Validations\BulkActionsValidation;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Validations\GetAllValidation;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Validations\Validation;
use App\Modules\PurchageManagement\PurchaseReturnOrder\Actions\BulkActions;
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