<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;



class GetSingleAddress
{
    static $model = \App\Modules\UserManagement\User\Models\UserAddressModel::class;

    public static function execute($id)
    {
        try {

            $address = self::$model::with('user_address_contact_person')->where('user_id', auth()->id())->where('id', $id)->first();
            if (!$address) {
                return messageResponse('Contact person not found...', [], 404, 'error');
            }
            return entityResponse($address);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
