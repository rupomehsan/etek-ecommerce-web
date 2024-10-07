<?php

namespace App\Modules\ConfigurationManagement\EmailConfiguration;

use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\All;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\Destroy;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\Show;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\Store;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\Update;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\SoftDelete;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\Restore;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\Import;
use App\Modules\ConfigurationManagement\EmailConfiguration\Validations\BulkActionsValidation;
use App\Modules\ConfigurationManagement\EmailConfiguration\Validations\GetAllValidation;
use App\Modules\ConfigurationManagement\EmailConfiguration\Validations\Validation;
use App\Modules\ConfigurationManagement\EmailConfiguration\Actions\BulkActions;
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
