<?php

namespace App\Modules\WebsiteApi\ProductQuestion;

use App\Modules\WebsiteApi\ProductQuestion\Actions\All;
use App\Modules\WebsiteApi\ProductQuestion\Actions\Destroy;
use App\Modules\WebsiteApi\ProductQuestion\Actions\Show;
use App\Modules\WebsiteApi\ProductQuestion\Actions\Store;
use App\Modules\WebsiteApi\ProductQuestion\Actions\Update;
use App\Modules\WebsiteApi\ProductQuestion\Actions\SoftDelete;
use App\Modules\WebsiteApi\ProductQuestion\Actions\Restore;
use App\Modules\WebsiteApi\ProductQuestion\Actions\Import;
use App\Modules\WebsiteApi\ProductQuestion\Validations\BulkActionsValidation;
use App\Modules\WebsiteApi\ProductQuestion\Validations\GetAllValidation;
use App\Modules\WebsiteApi\ProductQuestion\Validations\Validation;
use App\Modules\WebsiteApi\ProductQuestion\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index()
    {
        $data = All::execute();
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
