<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;



class GetContactPersonByAddressId
{
    static $contractPersonModel = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;

    public static function execute($id)
    {
        try {

            $contactPerson = self::$contractPersonModel::where('user_address_id', $id)->get();
            if (!$contactPerson) {
                return messageResponse('Contact person not found...', [], 404, 'error');
            }
            return entityResponse($contactPerson);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
