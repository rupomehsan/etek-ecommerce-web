<?php

namespace App\Modules\VatManagement\VatGroup;

use App\Modules\VatManagement\VatGroup\Actions\All;
use App\Modules\VatManagement\VatGroup\Actions\Destroy;
use App\Modules\VatManagement\VatGroup\Actions\Show;
use App\Modules\VatManagement\VatGroup\Actions\Store;
use App\Modules\VatManagement\VatGroup\Actions\Update;
use App\Modules\VatManagement\VatGroup\Actions\SoftDelete;
use App\Modules\VatManagement\VatGroup\Actions\Restore;
use App\Modules\VatManagement\VatGroup\Actions\Import;
use App\Modules\VatManagement\VatGroup\Validations\BulkActionsValidation;
use App\Modules\VatManagement\VatGroup\Validations\GetAllValidation;
use App\Modules\VatManagement\VatGroup\Validations\Validation;
use App\Modules\VatManagement\VatGroup\Actions\BulkActions;
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
