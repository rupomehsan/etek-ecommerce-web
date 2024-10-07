<?php

namespace App\Modules\ConfigurationManagement\SMSConfiguration;

use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\All;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\Destroy;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\Show;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\Store;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\Update;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\SoftDelete;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\Restore;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\Import;
use App\Modules\ConfigurationManagement\SMSConfiguration\Validations\BulkActionsValidation;
use App\Modules\ConfigurationManagement\SMSConfiguration\Validations\GetAllValidation;
use App\Modules\ConfigurationManagement\SMSConfiguration\Validations\Validation;
use App\Modules\ConfigurationManagement\SMSConfiguration\Actions\BulkActions;
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
