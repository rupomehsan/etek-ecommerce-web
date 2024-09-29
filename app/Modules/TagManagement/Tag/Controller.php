<?php

namespace App\Modules\TagManagement\Tag;

use App\Modules\TagManagement\Tag\Actions\All;
use App\Modules\TagManagement\Tag\Actions\Destroy;
use App\Modules\TagManagement\Tag\Actions\Show;
use App\Modules\TagManagement\Tag\Actions\Store;
use App\Modules\TagManagement\Tag\Actions\Update;
use App\Modules\TagManagement\Tag\Actions\SoftDelete;
use App\Modules\TagManagement\Tag\Actions\Restore;
use App\Modules\TagManagement\Tag\Actions\Import;
use App\Modules\TagManagement\Tag\Validations\BulkActionsValidation;
use App\Modules\TagManagement\Tag\Validations\GetAllValidation;
use App\Modules\TagManagement\Tag\Validations\Validation;
use App\Modules\TagManagement\Tag\Actions\BulkActions;
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