<?php

namespace App\Modules\SearchKeyWord;

use App\Modules\SearchKeyWord\Actions\All;
use App\Modules\SearchKeyWord\Actions\Destroy;
use App\Modules\SearchKeyWord\Actions\Show;
use App\Modules\SearchKeyWord\Actions\Store;
use App\Modules\SearchKeyWord\Actions\Update;
use App\Modules\SearchKeyWord\Actions\SoftDelete;
use App\Modules\SearchKeyWord\Actions\Restore;
use App\Modules\SearchKeyWord\Actions\Import;
use App\Modules\SearchKeyWord\Validations\BulkActionsValidation;
use App\Modules\SearchKeyWord\Validations\GetAllValidation;
use App\Modules\SearchKeyWord\Validations\Validation;
use App\Modules\SearchKeyWord\Actions\BulkActions;
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