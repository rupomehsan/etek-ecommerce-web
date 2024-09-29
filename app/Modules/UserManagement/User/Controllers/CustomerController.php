<?php

namespace App\Modules\UserManagement\User\Controllers;

use App\Modules\UserManagement\User\Actions\Customer\All;
use App\Modules\UserManagement\User\Actions\Customer\Destroy;
use App\Modules\UserManagement\User\Actions\Customer\Show;
use App\Modules\UserManagement\User\Actions\Customer\Store;
use App\Modules\UserManagement\User\Actions\Customer\Update;
use App\Modules\UserManagement\User\Validations\Validation;
use App\Modules\UserManagement\User\Validations\AddressValidation;
use App\Modules\UserManagement\User\Actions\Customer\BulkActions;
use App\Modules\UserManagement\User\Actions\Customer\SoftDelete;
use App\Modules\UserManagement\User\Actions\Customer\Restore;
use App\Http\Controllers\Controller as ControllersController;
use App\Modules\UserManagement\User\Actions\Customer\Import;
use App\Modules\UserManagement\User\Actions\Customer\AccountInfoUpdate;
use App\Modules\UserManagement\User\Actions\Customer\UpdateProfilePicture;
use App\Modules\UserManagement\User\Actions\Customer\ChangePassword;
use App\Modules\UserManagement\User\Actions\Customer\AddressInfoUpdate;
use App\Modules\UserManagement\User\Validations\BulkActionsValidation;
use App\Modules\UserManagement\User\Validations\GetAllValidation;
use App\Modules\UserManagement\User\Validations\PasswordValidation;

class CustomerController extends ControllersController
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

    public function update(Validation $request, $id)
    {

        $data = Update::execute($request, $id);
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
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }
    public function import()
    {
        $data = Import::execute();
        return $data;
    }
    public function AccountInfoUpdate(Validation $request)
    {
        $data = AccountInfoUpdate::execute($request);
        return $data;
    }
    public function AddressInfoUpdate(AddressValidation $request)
    {
        $data = AddressInfoUpdate::execute($request);
        return $data;
    }
    public function UpdateProfilePicture()
    {
        $data = UpdateProfilePicture::execute();
        return $data;
    }
    public function ChangePassword(PasswordValidation $request)
    {
        $data = ChangePassword::execute($request);
        return $data;
    }
}
