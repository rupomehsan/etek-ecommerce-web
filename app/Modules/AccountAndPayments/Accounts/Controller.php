<?php

namespace App\Modules\AccountAndPayments\Accounts;

use App\Modules\AccountAndPayments\Accounts\Actions\All;
use App\Modules\AccountAndPayments\Accounts\Actions\Destroy;
use App\Modules\AccountAndPayments\Accounts\Actions\Show;
use App\Modules\AccountAndPayments\Accounts\Actions\Store;
use App\Modules\AccountAndPayments\Accounts\Actions\Update;
use App\Modules\AccountAndPayments\Accounts\Actions\SoftDelete;
use App\Modules\AccountAndPayments\Accounts\Actions\Restore;
use App\Modules\AccountAndPayments\Accounts\Actions\Import;
use App\Modules\AccountAndPayments\Accounts\Validations\BulkActionsValidation;
use App\Modules\AccountAndPayments\Accounts\Validations\GetAllValidation;
use App\Modules\AccountAndPayments\Accounts\Validations\Validation;
use App\Modules\AccountAndPayments\Accounts\Actions\BulkActions;
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
