<?php

namespace App\Modules\WebsiteApi\ProductReview;

use App\Modules\WebsiteApi\ProductReview\Actions\All;
use App\Modules\WebsiteApi\ProductReview\Actions\Destroy;
use App\Modules\WebsiteApi\ProductReview\Actions\Show;
use App\Modules\WebsiteApi\ProductReview\Actions\Store;
use App\Modules\WebsiteApi\ProductReview\Actions\Update;
use App\Modules\WebsiteApi\ProductReview\Actions\SoftDelete;
use App\Modules\WebsiteApi\ProductReview\Actions\Restore;
use App\Modules\WebsiteApi\ProductReview\Actions\Import;
use App\Modules\WebsiteApi\ProductReview\Validations\BulkActionsValidation;
use App\Modules\WebsiteApi\ProductReview\Validations\GetAllValidation;
use App\Modules\WebsiteApi\ProductReview\Validations\Validation;
use App\Modules\WebsiteApi\ProductReview\Actions\BulkActions;
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