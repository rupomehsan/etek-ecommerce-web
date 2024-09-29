<?php

namespace App\Modules\UserManagement\User\Actions\User;



class Show
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute($slug)
    {
        try {
            $with = [
                'user_address:id,user_id,address,zip_code,is_present_address,is_permanent_address',
                'user_address.contact_persons:id,user_address_id,name,phone_number,email',
                'user_supplier_information'
            ];
            if (!$data = self::$model::query()->with($with)->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',[], 404, 'error');
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
