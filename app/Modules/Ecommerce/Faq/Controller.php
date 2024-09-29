<?php

namespace App\Modules\Ecommerce\Faq;

use App\Modules\Ecommerce\Faq\Actions\All;
use App\Modules\Ecommerce\Faq\Actions\Destroy;
use App\Modules\Ecommerce\Faq\Actions\Show;
use App\Modules\Ecommerce\Faq\Actions\Store;
use App\Modules\Ecommerce\Faq\Actions\Update;
use App\Modules\Ecommerce\Faq\Actions\SoftDelete;
use App\Modules\Ecommerce\Faq\Actions\Restore;
use App\Modules\Ecommerce\Faq\Actions\Import;
use App\Modules\Ecommerce\Faq\Validations\BulkActionsValidation;
use App\Modules\Ecommerce\Faq\Validations\GetAllValidation;
use App\Modules\Ecommerce\Faq\Validations\Validation;
use App\Modules\Ecommerce\Faq\Actions\BulkActions;
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