<?php

namespace App\Modules\LocationManagement\District;

use App\Modules\LocationManagement\District\Actions\All;
use App\Modules\LocationManagement\District\Actions\Destroy;
use App\Modules\LocationManagement\District\Actions\Show;
use App\Modules\LocationManagement\District\Actions\Store;
use App\Modules\LocationManagement\District\Actions\Update;
use App\Modules\LocationManagement\District\Actions\SoftDelete;
use App\Modules\LocationManagement\District\Actions\Restore;
use App\Modules\LocationManagement\District\Actions\Import;
use App\Modules\LocationManagement\District\Actions\getDistrictByDivisionId;
use App\Modules\LocationManagement\District\Validations\BulkActionsValidation;
use App\Modules\LocationManagement\District\Validations\GetAllValidation;
use App\Modules\LocationManagement\District\Validations\Validation;
use App\Modules\LocationManagement\District\Actions\BulkActions;
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
    public function getDistrictByDivisionId( $division_id )
    {
        $data = getDistrictByDivisionId::execute($division_id);
        return $data;
    }

}
