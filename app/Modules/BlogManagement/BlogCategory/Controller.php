<?php

namespace App\Modules\BlogManagement\BlogCategory;

use App\Modules\BlogManagement\BlogCategory\Actions\All;
use App\Modules\BlogManagement\BlogCategory\Actions\Destroy;
use App\Modules\BlogManagement\BlogCategory\Actions\Show;
use App\Modules\BlogManagement\BlogCategory\Actions\Store;
use App\Modules\BlogManagement\BlogCategory\Actions\Update;
use App\Modules\BlogManagement\BlogCategory\Actions\SoftDelete;
use App\Modules\BlogManagement\BlogCategory\Actions\Restore;
use App\Modules\BlogManagement\BlogCategory\Actions\Import;
use App\Modules\BlogManagement\BlogCategory\Validations\BulkActionsValidation;
use App\Modules\BlogManagement\BlogCategory\Validations\GetAllValidation;
use App\Modules\BlogManagement\BlogCategory\Validations\Validation;
use App\Modules\BlogManagement\BlogCategory\Actions\BulkActions;
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