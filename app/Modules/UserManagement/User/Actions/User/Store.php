<?php

namespace App\Modules\UserManagement\User\Actions\User;

use Illuminate\Support\Facades\Hash;
use App\Modules\UserManagement\User\Validations\Validation;


class Store
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    static $userAddress = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userAddressContactPerson = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    static $userShow = \App\Modules\UserManagement\User\Actions\User\Show::class;
    public static function execute(Validation $request)
    {
        try {
            // dd($request->userAddress);
            $requestData = $request->validated();
            unset($requestData['confirmed']);
            $userData = self::$model::create($requestData);

            if(request()->get('password')) {
                $requestData['password'] = Hash::make(request()->get('password'));
            }else{
             unset( $requestData['password'] );
            }

            if ($request->userAddress) {

                $userAddressContactPersons = [];
                foreach ($request->userAddress as $key => $address) {

                    $address = (object) $address;
                    $userAddressData = [
                        'user_id' => $userData->id ?? null,
                            'is_shipping' => $address->is_shipping ?? null,
                            'is_billing' => $address->is_billing ?? null,
                            'address_types' => $address->address_types ?? null,
                            'address' => $address->address ?? null,
                            'country_id' => $address->country_id ?? null,
                            'state_division_id' => $address->state_division_id ?? null,
                            'division_id' => $address->division_id ?? null,
                            'district_id' => $address->district_id ?? null,
                            'station_id' => $address->station_id ?? null,
                            'city_id' => $address->city_id ?? null,
                            'zip_code' => $address->zip_code ?? null,
                            'is_present_address' => $address->is_present_address ?? null,
                            'is_permanent_address' => $address->is_permanent_address ?? null,
                    ];



                    $userAddressDataStore = self::$userAddress::create($userAddressData);

                    if (isset($address->contact_persons)) {
                        foreach ($address->contact_persons as $contactPerson) {
                            $contactPerson = (object) $contactPerson;
                            $userAddressContactPersons[] = [
                                'user_id' => $userData->id ?? null,
                                    'user_address_id' => $userAddressDataStore->id ?? null,
                                    'name' => $contactPerson->name ?? null,
                                    'phone_number' => $contactPerson->phone_number ?? null,
                                    'email' => $contactPerson->email ?? null,
                            ];
                        }
                    }
                }

                if (!empty($userAddressContactPersons)) {
                    self::$userAddressContactPerson::insert($userAddressContactPersons);
                }
            }

            return self::$userShow::execute($userData->slug);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
