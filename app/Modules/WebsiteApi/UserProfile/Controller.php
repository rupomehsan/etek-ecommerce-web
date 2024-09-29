<?php

namespace App\Modules\WebsiteApi\UserProfile;

use App\Modules\WebsiteApi\UserProfile\Actions\GetUserDashboardInfo;
use App\Modules\WebsiteApi\UserProfile\Actions\AddressInfoCreate;
use App\Modules\WebsiteApi\UserProfile\Actions\AddressInfoUpdate;
use App\Modules\WebsiteApi\UserProfile\Actions\UpdateProfilePicture;
use App\Modules\WebsiteApi\UserProfile\Actions\ChangePassword;
use App\Modules\WebsiteApi\UserProfile\Actions\SetDefaultAddress;
use App\Modules\WebsiteApi\UserProfile\Actions\GetContactPersonByAddressId;
use App\Modules\WebsiteApi\UserProfile\Actions\GetSingleAddress;
use App\Modules\WebsiteApi\UserProfile\Actions\AccountInfoUpdate;

use App\Modules\WebsiteApi\UserProfile\Validations\AddressValidation;
use App\Modules\WebsiteApi\UserProfile\Validations\PasswordValidation;

use App\Http\Controllers\Controller as ControllersController;
use Illuminate\Support\Facades\Request;

class Controller extends ControllersController
{

    public function getUserDashboardInfo()
    {
        $data = GetUserDashboardInfo::execute();
        return $data;
    }
    public function AddressInfoCreate(AddressValidation $request)
    {
        $data = AddressInfoCreate::execute($request);
        return $data;
    }

    public function AddressInfoUpdate(AddressValidation $request, $id)
    {
        $data = AddressInfoUpdate::execute($request,$id);
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
    public function SetDefaultAddress()
    {
        $data = SetDefaultAddress::execute();
        return $data;
    }
    public function GetContactPersonByAddressId($id)
    {
        $data = GetContactPersonByAddressId::execute($id);
        return $data;
    }
    public function GetSingleAddress($id)
    {
        $data = GetSingleAddress::execute($id);
        return $data;
    }
    public function AccountInfoUpdate(Request $request)
    {
        $data = AccountInfoUpdate::execute($request);
        return $data;
    }

}
