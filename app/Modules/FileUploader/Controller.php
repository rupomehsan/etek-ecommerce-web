<?php

namespace App\Modules\FileUploader;

use App\Modules\FileUploader\Actions\All;
use App\Modules\FileUploader\Actions\Destroy;
use App\Modules\FileUploader\Actions\Show;
use App\Modules\FileUploader\Actions\Store;
use App\Modules\FileUploader\Actions\Update;
use App\Modules\FileUploader\Actions\SoftDelete;
use App\Modules\FileUploader\Actions\Restore;
use App\Modules\FileUploader\Actions\Import;
use App\Modules\FileUploader\Validations\BulkActionsValidation;
use App\Modules\FileUploader\Validations\GetAllValidation;
use App\Modules\FileUploader\Validations\Validation;
use App\Modules\FileUploader\Actions\BulkActions;
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