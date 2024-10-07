<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;



class SetDefaultAddress
{
    static $model = \App\Modules\UserManagement\User\Models\UserAddressModel::class;

    public static function execute()
    {
        try {

            self::$model::where("user_id", auth()->id())->update(['is_default' => 0]);
            $address = self::$model::find(request()->id);
            $address->is_default = 1;
            $address->save();

            return messageResponse('Address set successfully', $address, 201, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
