<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;

class AddressInfoCreate
{
    static $model = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $contactPersonmodel = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;

    public static function execute($request)
    {
        try {
            // dd($request->all());

            $requestData = $request->validated();
            $requestData['user_id'] = auth()->id();
            $requestData['is_shipping'] = 1;
            $requestData['is_billing'] = 0;
            $requestData['address_types'] = "delivery";
            if ($userData = self::$model::create($requestData)) {
                if ($request->contact_person && count($request->contact_person)) {
                    foreach ($request->contact_person as $item) {
                        self::$contactPersonmodel::create([
                            'user_id' => $userData->user_id,
                            'user_address_id' => $userData->id,
                            'name' => $item['name'],
                            'email' => $item['email'],
                            'phone_number' => $item['phone_number'],
                        ]);
                    }
                }

                return messageResponse('Address successfully  created', $userData, 201, 'success');
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
