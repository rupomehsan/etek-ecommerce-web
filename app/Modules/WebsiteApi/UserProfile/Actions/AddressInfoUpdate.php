<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;




class AddressInfoUpdate
{
    static $model = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $contactPersonmodel = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    public static function execute($request, $id)
    {
        try {
            // dd(count($request->contact_person));
            //    dd($request->all(),auth()->user()->id);
            $requestData = $request->validated();
            if ($userData = self::$model::where("user_id", auth()->id())->where('id', $id)->first()) {
                if ($request->contact_person && count($request->contact_person)) {
                    self::$contactPersonmodel::where('user_id', auth()->id())->delete();
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
            }

            $userData->update($requestData);
            return messageResponse('Address info updated', $userData, 201, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
