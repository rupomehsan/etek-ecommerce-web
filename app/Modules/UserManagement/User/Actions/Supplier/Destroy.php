<?php

namespace App\Modules\UserManagement\User\Actions\Supplier;

class Destroy
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute()
    {
        try {

            if (!$data = self::$model::where('slug', request()->slug)->first()) {
                return messageResponse('Data not found...', [], 404, 'error');
            }

            if ($data->user_address()->count()) {
                $data->user_address()->where('user_id', $data->id)->delete();
            }

            if ($data->user_address_contact_person()->count()) {

                $data->user_address_contact_person()->where('user_id', $data->id)->delete();
            }

            if ($data->user_supplier_information()->count()) {
                $data->user_supplier_information()->where('user_id', $data->id)->delete();
            }


            $data->delete();

            return messageResponse('Item Successfully deleted');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
