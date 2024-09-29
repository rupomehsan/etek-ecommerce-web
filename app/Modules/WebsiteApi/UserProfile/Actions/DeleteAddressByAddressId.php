<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;


use Illuminate\Support\Facades\Hash;

class DeleteAddressByAddressId
{
    static $model = \App\Modules\UserManagement\User\Models\UserAddressModel::class;


    public static function execute($id)
    {
        try {
            $address = self::$model::where('user_id', auth()->id())->where('id', $id)->first();
            if (!$address) {
                return messageResponse('Contact person not found...', [], 404, 'error');
            }
            if ($address->is_default == 1) {
                return messageResponse('Default address cannot be deleted...', [], 404, 'error');
            }
            $address->delete();
            return messageResponse('Address successfully deleted', [], 201, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
