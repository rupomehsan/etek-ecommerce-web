<?php

namespace App\Modules\VatManagement\Vat;

use App\Modules\VatManagement\Vat\Actions\All;
use App\Modules\VatManagement\Vat\Actions\Destroy;
use App\Modules\VatManagement\Vat\Actions\Show;
use App\Modules\VatManagement\Vat\Actions\Store;
use App\Modules\VatManagement\Vat\Actions\Update;
use App\Modules\VatManagement\Vat\Actions\SoftDelete;
use App\Modules\VatManagement\Vat\Actions\Restore;
use App\Modules\VatManagement\Vat\Actions\Import;
use App\Modules\VatManagement\Vat\Validations\BulkActionsValidation;
use App\Modules\VatManagement\Vat\Validations\GetAllValidation;
use App\Modules\VatManagement\Vat\Validations\Validation;
use App\Modules\VatManagement\Vat\Actions\BulkActions;
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
