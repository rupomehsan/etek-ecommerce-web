<?php

namespace App\Modules\AccountAndPayments\AccountExpenditures;

use App\Modules\AccountAndPayments\AccountExpenditures\Actions\All;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\Destroy;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\Show;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\Store;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\Update;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\SoftDelete;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\Restore;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\Import;
use App\Modules\AccountAndPayments\AccountExpenditures\Validations\BulkActionsValidation;
use App\Modules\AccountAndPayments\AccountExpenditures\Validations\GetAllValidation;
use App\Modules\AccountAndPayments\AccountExpenditures\Validations\Validation;
use App\Modules\AccountAndPayments\AccountExpenditures\Actions\BulkActions;
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
