<?php

namespace App\Modules\WebsiteApi\WebsiteSubscriber;

use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\All;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\Destroy;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\Show;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\Store;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\Update;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\SoftDelete;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\Restore;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\Import;
use App\Modules\WebsiteApi\WebsiteSubscriber\Validations\BulkActionsValidation;
use App\Modules\WebsiteApi\WebsiteSubscriber\Validations\GetAllValidation;
use App\Modules\WebsiteApi\WebsiteSubscriber\Validations\Validation;
use App\Modules\WebsiteApi\WebsiteSubscriber\Actions\BulkActions;
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